# SADARIN V2 — Project Structure

## Controller Structure

```text
app/Http/Controllers/
│
├── Homepage/
│   ├── SadarinHomepageController.php
│   └── SadarinLoginController.php
│
├── Dashboard/
│   ├── SadarinAdminController.php
│   ├── SadarinArsiparisController.php
│   └── SadarinUserController.php
│
├── Archive/
│   └── SadarinArchiveController.php
│
├── Master/
│   ├── SadarinUnitController.php
│   ├── SadarinProgramController.php
│   ├── SadarinKegiatanController.php
│   ├── SadarinSubKegiatanController.php
│   ├── SadarinDocumentTypeController.php
│   └── SadarinTagController.php
│
└── System/
    ├── SadarinRoleController.php
    ├── SadarinPermissionController.php
    └── SadarinAccessLogController.php