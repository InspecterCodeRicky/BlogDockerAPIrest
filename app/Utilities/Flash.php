<?php
class Flash
{
    public static function setFlash(string $message, string $status ="error"): void
    {
        $_SESSION['flash'] = $message;
        $_SESSION['statusFlash'] = $status;
    }

    public static function hasFlash(): bool
    {
        return isset($_SESSION['flash'], $_SESSION['statusFlash']);
    }

    public static function getFlash() : array
    {
        if (isset($_SESSION['flash']) && isset($_SESSION['statusFlash'])) {
            $message = $_SESSION['flash'];
            $statusFlash = $_SESSION['statusFlash'];
            unset($_SESSION['flash'], $_SESSION['statusFlash']);
            return array("flash" => $message, "statusFlash"=>$statusFlash);
        }
    }
}