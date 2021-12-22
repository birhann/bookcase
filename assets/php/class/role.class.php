<?php
class Role
{
    protected $Yetkiler;

    protected function __construct()
    {
        $this->yetkiler = array();
    }

    // return a role object with associated permissions
    public static function getRolePerms($rolID)
    {
        $Rol = new Role();
        $RollerGetir = mysqli_query(
            $GLOBALS['DBC'],
            "SELECT t2.yetkiIsmi FROM rol_yetki as t1
         JOIN yetkiler as t2 ON t1.yetkiID = t2.yetkiID
         WHERE t1.RolID = {$rolID}"
        );

        while ($RolBilgi = mysqli_fetch_assoc($RollerGetir)) {
            $Rol->yetkiler[$RolBilgi["yetkiIsmi"]] = true;
        }
        return $Rol;
    }

    // check if a permission is set
    public function hasPerm($yetki)
    {
        return isset($this->yetkiler[$yetki]);
    }
}
