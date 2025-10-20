import { app, BrowserWindow, ipcMain } from "electron";
import { exec } from "child_process";
import path from "path";
import { fileURLToPath } from "url";

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

let laravelServer;
let mainWindow;

function createWindow() {
    mainWindow = new BrowserWindow({
        width: 1200,
        height: 800,
        webPreferences: {
            preload: path.join(__dirname, "preload.js"),
            contextIsolation: true,
            sandbox: false,
            nodeIntegration: false,
            nativeWindowOpen: true, // allow window.open compatibility
        },
    });

    // Run Laravel app and queue worker
    laravelServer = exec("php artisan serve --host=127.0.0.1 --port=8000", { cwd: __dirname });
    exec("php artisan queue:work", { cwd: __dirname });

    // Load Laravel app
    mainWindow.loadURL("http://127.0.0.1:8000");

    // Handle any popup window (window.open)
    mainWindow.webContents.setWindowOpenHandler(({ url }) => {
        const printWin = new BrowserWindow({
            show: false,
            webPreferences: { sandbox: false },
        });

        printWin.loadURL(url);

        printWin.webContents.once("did-finish-load", () => {
            // trigger native print dialog
            printWin.webContents.print({ silent: false, printBackground: true });
        });

        return { action: "deny" }; // prevent opening a new visible window
    });
}

// ✅ IPC listener for programmatic print calls (optional)
ipcMain.on("print-receipt", async (event, url) => {
    const printWindow = new BrowserWindow({ show: false });
    await printWindow.loadURL(url);
    printWindow.webContents.on("did-finish-load", () => {
        printWindow.webContents.print({ silent: false, printBackground: true });
    });
});

app.whenReady().then(createWindow);

app.on("window-all-closed", () => {
    if (process.platform !== "darwin") app.quit();
});

app.on("quit", () => {
    if (laravelServer) laravelServer.kill();
});
