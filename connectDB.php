<?php
class connectDB {
    public static function connect(): PDO {
        return new PDO("mysql:host=localhost;dbname=logIn", "root", "iskan2066");
    }
    public static function connectPWTC(): PDO {
        return new PDO("mysql:host=localhost;dbname=pwtc", "root", "iskan2066");
    }
}

