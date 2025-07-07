<?php

namespace App\Helpers;

use Defuse\Crypto\Crypto;
use Defuse\Crypto\Key;
use Defuse\Crypto\Exception\CryptoException;
use RuntimeException;

class CryptoHelper
{
    /**
     * Devuelve la clave de cifrado cargada desde APP_ENCRYPTION_KEY
     *
     * @throws RuntimeException si no se encuentra o no es válida
     */
    protected static function getKey(): Key
    {
        $keyString = env('APP_ENCRYPTION_KEY');

        if (empty($keyString)) {
            throw new RuntimeException('La clave de cifrado (APP_ENCRYPTION_KEY) no está definida en el archivo .env.');
        }

        try {
            return Key::loadFromAsciiSafeString($keyString);
        } catch (\Throwable $e) {
            throw new RuntimeException('La clave de cifrado es inválida o está corrupta: ' . $e->getMessage());
        }
    }

    /**
     * Cifra una cadena de texto
     *
     * @param string $data Texto plano a cifrar
     * @return string Texto cifrado
     * @throws CryptoException|RuntimeException
     */
    public static function encrypt(string $data): string
    {
        if (trim($data) === '') {
            return '';
        }

        return Crypto::encrypt($data, self::getKey());
    }

    /**
     * Descifra una cadena cifrada
     *
     * @param string $encrypted Texto cifrado
     * @return string Texto plano
     * @throws CryptoException|RuntimeException
     */
    public static function decrypt(string $encrypted): string
    {
        if (trim($encrypted) === '') {
            return '';
        }

        return Crypto::decrypt($encrypted, self::getKey());
    }

    /**
     * Verifica si un string está cifrado correctamente
     *
     * @param string $data
     * @return bool
     */
    public static function isEncrypted(string $data): bool
    {
        try {
            self::decrypt($data);
            return true;
        } catch (\Throwable $e) {
            return false;
        }
    }
}
