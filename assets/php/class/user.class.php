<?php
class User
{

  protected $_userID;
  public $_userInfo;
  private $Roller;

  public function __construct($_userID)
  {
    $this->_userID = $_userID;
    $this->KullaniciBilgiGetir();
    $this->YetkileriGetir();
  }

  // Veritabanından Kullanıcı Bilgilerini Getiriyoruz.
  protected function KullaniciBilgiGetir()
  {
    $KontrolOturum = mysqli_query($GLOBALS['DBC'], "SELECT * FROM kullanicilar WHERE kul_ID = '{$this->_userID}'");
    $this->_userInfo = mysqli_fetch_assoc($KontrolOturum);
  }

  // Veritabanından Kullanıcının Yetkilerini Getiriyoruz.
  protected function YetkileriGetir()
  {
    $this->Roller = array();
    $KontrolRoller = mysqli_query($GLOBALS['DBC'], "SELECT t1.rol_id, t2.RolIsmi FROM kullanici_rol as t1 JOIN roller as t2 ON t1.rol_id = t2.RolId WHERE t1.kul_ID = {$this->_userID}");

    while ($row = mysqli_fetch_assoc($KontrolRoller)) {
      $this->Roller[$row["RolIsmi"]] = Role::getRolePerms($row["rol_id"]);
    }
  }

  public function getAdS()
  {
    return $this->_userInfo['kul_Ad'] . ' ' . mb_substr($this->_userInfo['kul_Soyad'], 0, 1) . '.';
  }

  public function getAdSoyad()
  {
    return $this->_userInfo['kul_Ad'] . ' ' . $this->_userInfo['kul_Soyad'];
  }

  public function getID()
  {
    return $this->_userInfo['kul_ID'];
  }

  public function YetkiVarMi($Perm)
  {
    foreach ($this->Roller as $Rol) {
      if ($Rol->hasPerm($Perm)) {
        return true;
      }
    }
    return false;
  }

  public function YetkiliMi()
  {
    if (count($this->Roller) > 0) return true;
    return false;
  }
}
