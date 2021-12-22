<link rel="stylesheet" type="text/css" href="assets/css/highcharts.css">
<?php
$KitapSQL = mysqli_query($GLOBALS['DBC'], "SELECT * FROM kitaplar");
$YazarSQL = mysqli_query($GLOBALS['DBC'], "SELECT * FROM yazarlar");
$EmanetSQL = mysqli_query($GLOBALS['DBC'], "SELECT * FROM emanetler");
$UyeSQL = mysqli_query($GLOBALS['DBC'], "SELECT * FROM kullanicilar");
?>
<div class="ui one column grid">
    <div class="row">
        <div class="column">
            <h4 class="ui horizontal divider header">
                <i class="book icon"></i> Recently Added Books
            </h4>
            <?php
            $KitaplarSQL = mysqli_query($GLOBALS['DBC'], "SELECT * FROM kitaplar, yazarlar, turler WHERE kitaplar.yaz_ID = yazarlar.yaz_ID && kitaplar.ktur_ID = turler.ktur_ID ORDER BY kit_ID DESC LIMIT 4");
            if (mysqli_num_rows($KitaplarSQL) > 0) {
            ?>
                <div class="ui special four cards">
                    <?php while ($KitapBilgi = mysqli_fetch_assoc($KitaplarSQL)) { ?>
                        <div class="card">
                            <div class="blurring dimmable image">
                                <div class="ui dimmer">
                                    <div class="content">
                                        <div class="center">
                                            <div class="ui inverted button">İncele</div>
                                        </div>
                                    </div>
                                </div>
                                <img src="assets/php/viewPhoto.php?Tur=K&IMG=../images/bookCover/<?= $KitapBilgi['kit_Foto']; ?>">
                            </div>
                            <div class="content">
                                <a class="header"><?= $KitapBilgi['kit_Ad']; ?></a>
                                <div class="meta">
                                    <span class="date">
                                        <div class="ui label"><i class="archive icon"></i> <?= $KitapBilgi['ktur_Ad']; ?> / <?= $KitapBilgi['kit_YTarih']; ?></div>
                                    </span>
                                </div>
                            </div>
                            <div class="content">
                                <span class="right floated">
                                    <i class="heart outline like icon"></i>
                                    17 beğeni
                                </span>
                                <i class="comment icon"></i>
                                3 yorum
                            </div>
                            <div class="extra content">
                                <a>
                                    <i class="pencil alternated icon"></i>
                                    <b>Yazar :</b> <?= $KitapBilgi['yaz_Ad']; ?> <?= $KitapBilgi['yaz_Soyad']; ?>
                                </a>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php } else { ?>
                <div class="ui error message">
                    <div class="header">
                        Kitap bulunamadı!
                    </div>
                    <p>Sisteme henüz kitap eklenmemiş.</p>
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="row">
        <div class="column">
            <h4 class="ui horizontal divider header">
                <i class="pencil alternated icon"></i> Recently Added Authors
            </h4>
            <?php
            $YazarlarSQL = mysqli_query($GLOBALS['DBC'], "SELECT * FROM yazarlar ORDER BY yaz_ID DESC LIMIT 4");
            if (mysqli_num_rows($YazarlarSQL) > 0) {
            ?>
                <div class="ui special four cards">
                    <?php
                    while ($YazarBilgi = mysqli_fetch_assoc($YazarlarSQL)) {
                        $YazarKitap = mysqli_query($GLOBALS['DBC'], "SELECT * FROM kitaplar WHERE yaz_ID = {$YazarBilgi['yaz_ID']}");
                    ?>
                        <div class="card">
                            <div class="blurring dimmable image">
                                <div class="ui dimmer">
                                    <div class="content">
                                        <div class="center">
                                            <div class="ui inverted button">Görüntüle</div>
                                        </div>
                                    </div>
                                </div>
                                <img src="assets/php/viewPhoto.php?IMG=../images/authorPhoto/<?= $YazarBilgi['yaz_Foto']; ?>">
                            </div>
                            <div class="content">
                                <a class="header"><?= $YazarBilgi['yaz_Ad']; ?> <?= $YazarBilgi['yaz_Soyad']; ?></a>
                                <div class="meta">
                                    <span class="date"><?= $YazarBilgi['yaz_DTarih']; ?> / <?= $YazarBilgi['yaz_DYeri']; ?></span>
                                </div>
                            </div>
                            <div class="extra content">
                                <a>
                                    <i class="book icon"></i>
                                    Kitap Sayısı : <a class="ui grey mini circular label"><?= mysqli_num_rows($YazarKitap); ?></a>
                                </a>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php } else { ?>
                <div class="ui error message">
                    <div class="header">
                        Yazar bulunamadı!
                    </div>
                    <p>Sisteme henüz yazar eklenmemiş.</p>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<h4 class="ui horizontal divider header">
    <i class="chart bar icon"></i> Statistics
</h4>
<div class="ui center aligned four column grid statistics">
    <div class="row">
        <div class="column">
            <div class="statistic">
                <div class="value">
                    <?= number_format(mysqli_num_rows($KitapSQL)); ?>
                </div>
                <div class="label">
                    <i class="book icon"></i> Registered Book
                </div>
            </div>
        </div>
        <div class="column">
            <div class="statistic">
                <div class="value">
                    <?= number_format(mysqli_num_rows($YazarSQL)); ?>
                </div>
                <div class="label">
                    <i class="pencil alternate icon"></i> Registered Author
                </div>
            </div>
        </div>
        <div class="column">
            <div class="statistic">
                <div class="value">
                    <?= number_format(mysqli_num_rows($EmanetSQL)); ?>
                </div>
                <div class="label">
                    <i class="exchange icon"></i> Escrow count
                </div>
            </div>
        </div>
        <div class="column">
            <div class="statistic">
                <div class="value">
                    <?= number_format(mysqli_num_rows($UyeSQL)); ?>
                </div>
                <div class="label">
                    <i class="user circle icon"></i> member
                </div>
            </div>
        </div>
    </div>
</div>
<h4 class="ui horizontal divider header">
    <i class="graph bar icon"></i> Graphs
</h4>
<div class="ui center aligned one column grid">
    <div class="row">
        <div class="column">
            <figure class="highcharts-figure">
                <div id="highchartscontainer"></div>
                <p class="highcharts-description">
                    Chart showing data loaded dynamically. The individual data points can
                    be clicked to display more information.
                </p>
            </figure>
        </div>
    </div>

</div>

<div class="ui grid">
    <div class="ten wide column">
        <h4 class="ui horizontal divider header">
            <i class="calendar alternate outline icon"></i> Akış
        </h4>
        <div class="ui feed">
            <?php
            $AkisSQL = mysqli_query($GLOBALS['DBC'], "SELECT * FROM akis_log, kullanicilar WHERE akis_log.kul_ID = kullanicilar.kul_ID ORDER BY akis_Zaman DESC LIMIT 5");
            if (mysqli_num_rows($AkisSQL) > 0) {
                while ($AkisBilgi = mysqli_fetch_assoc($AkisSQL)) {
            ?>
                    <div class="event">
                        <div class="label">
                            <img src="assets/images/avatar/<?= ($AkisBilgi['kul_Foto']) ? $AkisBilgi['kul_Foto'] : 'default.jpg'; ?>">
                        </div>
                        <div class="content">
                            <div class="summary">
                                <a class="user button"><?= $AkisBilgi['kul_Ad']; ?> <?= mb_substr($AkisBilgi['kul_Soyad'], 0, 1); ?>.</a>,
                                <?php
                                $Params = json_decode($AkisBilgi['akis_Param'], true);
                                if ($AkisBilgi['akis_Tur'] == 1) {
                                    $AkisKitapBilgi = mysqli_fetch_assoc(mysqli_query($GLOBALS['DBC'], "SELECT * FROM kitaplar, yazarlar WHERE kitaplar.yaz_ID = yazarlar.yaz_ID && kitaplar.kit_ID = '{$Params['BookID']}'"));
                                ?>
                                    <a class="book popup" data-title="<?= $AkisKitapBilgi['kit_Ad']; ?>" data-content="<?= $AkisKitapBilgi['yaz_Ad']; ?> <?= $AkisKitapBilgi['yaz_Soyad']; ?> / <?= $AkisKitapBilgi['kit_YTarih']; ?>"><?= $AkisKitapBilgi['kit_Ad']; ?></a> isimli kitabı sisteme ekledi.
                                <?php
                                } else if ($AkisBilgi['akis_Tur'] == 2) {
                                    $AkisYazarBilgi = mysqli_fetch_assoc(mysqli_query($GLOBALS['DBC'], "SELECT * FROM yazarlar WHERE yaz_ID = '{$Params['YazarID']}'"));
                                ?>
                                    <a class="yazar popup" data-title="<?= $AkisYazarBilgi['yaz_Ad']; ?> <?= $AkisYazarBilgi['yaz_Soyad']; ?>" data-content="<?= $AkisYazarBilgi['yaz_DYeri']; ?> / <?= $AkisYazarBilgi['yaz_DTarih']; ?>"><?= $AkisYazarBilgi['yaz_Ad']; ?> <?= $AkisYazarBilgi['yaz_Soyad']; ?></a> isimli yazarı sisteme ekledi.
                                <?php } else if ($AkisBilgi['akis_Tur'] == 3) {
                                    $AkisTurBilgi = mysqli_fetch_assoc(mysqli_query($GLOBALS['DBC'], "SELECT * FROM turler WHERE ktur_ID = '{$Params['TurID']}'"));
                                ?>
                                    <a class="tur"><?= $AkisTurBilgi['ktur_Ad']; ?></a> türünü sisteme ekledi.
                                <?php } else if ($AkisBilgi['akis_Tur'] == 4) {
                                    $AkisYEVBilgi = mysqli_fetch_assoc(mysqli_query($GLOBALS['DBC'], "SELECT * FROM yayinevleri WHERE yev_ID = '{$Params['YayinevID']}'"));
                                ?>
                                    <a class="tur"><?= $AkisYEVBilgi['yev_Ad']; ?></a> yayınevini sisteme ekledi.
                                <?php } ?>
                                <div class="date">
                                    <?= timeAgo($AkisBilgi['akis_Zaman']); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }
            } else { ?>
                <div class="ui negative message">
                    <div class="header">
                        Akış yeni bir bilgi yok!
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="six wide column">
        <h4 class="ui horizontal divider header">
            <i class="calendar alternate outline icon"></i> En Çok Okunan
        </h4>
        <div class="ui middle aligned divided list">
            <?php
            $EnCokOkunanSQL = mysqli_query($GLOBALS['DBC'], "SELECT kit_ID, Count(*) AS EmanetSayisi FROM emanetler WHERE kit_ID IS NOT NULL GROUP BY kit_ID ORDER BY EmanetSayisi DESC");
            if (mysqli_num_rows($EnCokOkunanSQL) > 0) {
                while ($EnCokOkunanBilgi = mysqli_fetch_assoc($EnCokOkunanSQL)) {
                    $KitapBilgileri = mysqli_fetch_assoc(mysqli_query($GLOBALS['DBC'], "SELECT * FROM kitaplar, yazarlar WHERE kitaplar.yaz_ID = yazarlar.yaz_ID && kitaplar.kit_ID = {$EnCokOkunanBilgi['kit_ID']}"));
            ?>
                    <div class="item">
                        <img class="ui avatar image" src="assets/php/viewPhoto.php?IMG=../images/bookCover/<?= $KitapBilgileri['kit_Foto']; ?>">
                        <div class="content">
                            <a class="header"><?= $KitapBilgileri['kit_Ad']; ?></a>
                            <?= $KitapBilgileri['yaz_Ad']; ?> <?= $KitapBilgileri['yaz_Soyad']; ?> / <?= $KitapBilgileri['kit_YTarih']; ?>
                        </div>
                    </div>
            <?php }
            }
            ?>
        </div>
    </div>
</div>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script src="assets/js/highchartsScript.js"></script>