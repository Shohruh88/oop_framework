<?php

// Yaxshi amaliyot: Interfeysdan foydalanish
interface LoggerInterface {
    public function log($message);
}

class FileLogger implements LoggerInterface {
    public function log($message) {
        echo "Faylga yozildi: " . $message . "\n";
    }
}

class DatabaseLogger implements LoggerInterface {
    public function log($message) {
        echo "Ma'lumotlar bazasiga yozildi: " . $message . "\n";
    }
}

class UserController {
    private LoggerInterface $logger; // Interfeysga bog'lanamiz

    // !!! YECHIM: Bog'liqlik (LoggerInterface) konstruktor orqali qabul qilinadi !!!
    public function __construct(LoggerInterface $logger) {
        $this->logger = $logger;
    }

    public function createUser($name) {
        // Foydalanuvchi yaratish logikasi...
        echo "Foydalanuvchi '$name' yaratildi.\n";
        $this->logger->log("Foydalanuvchi '$name' yaratildi."); // Qaysi loggerligi muhim emas
    }
}

// --- Endi bog'liqlik tashqarida yaratiladi va inject qilinadi ---

// 1-holat: FileLogger bilan ishlatish
$fileLogger = new FileLogger();
$controller1 = new UserController($fileLogger); // FileLogger obyektini beramiz
$controller1->createUser("Ali");

echo "----\n";

// 2-holat: DatabaseLogger bilan ishlatish (UserController kodini o'zgartirmasdan!)
$dbLogger = new DatabaseLogger();
$controller2 = new UserController($dbLogger); // DatabaseLogger obyektini beramiz
$controller2->createUser("Vali");

?>