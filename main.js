import { app, BrowserWindow } from "electron";
import { exec } from "child_process";
import path from "path";
import { fileURLToPath } from "url";

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

let laravelServer;

function createWindow() {
    const win = new BrowserWindow({
        width: 1200,
        height: 800,
        webPreferences: { nodeIntegration: false },
    });

    // تشغيل Laravel
    laravelServer = exec("php artisan serve --host=127.0.0.1 --port=8000", {
        cwd: __dirname, // مسار مشروع Laravel
    });
    laravelServer = exec("php artisan queue:work", {
        cwd: __dirname, // مسار مشروع Laravel
    });
    // تحميل المشروع في نافذة Electron
    win.loadURL("http://127.0.0.1:8000");
}

app.on("ready", createWindow);

app.on("window-all-closed", () => {
    if (process.platform !== "darwin") {
        app.quit();
    }
});

app.on("quit", () => {
    if (laravelServer) laravelServer.kill();
});
