<div class="ui fixed inverted menu">
  <div class="ui container">
    <a href="/home.php" class="header item">
      <img class="logo" src="assets/images/logo.png">
      BookCase
    </a>
    <a href="/home.php" class="item <?= ($_PGV == 'Home') ? 'active' : ''; ?>">Home</a>
    <div class="right menu">
      <?php if ($_User->YetkiliMi()) { ?>
        <div class="ui simple dropdown item">
          <i class="plus square icon"></i> Add
          <div class="menu">
            <?php if (
              $_User->YetkiVarMi('showEmanet') || $_User->YetkiVarMi('addEmanet') ||
              $_User->YetkiVarMi('showKitap') || $_User->YetkiVarMi('addKitap') ||
              $_User->YetkiVarMi('showYazar') || $_User->YetkiVarMi('addYazar') ||
              $_User->YetkiVarMi('showYayinevi') || $_User->YetkiVarMi('addYayinevi') ||
              $_User->YetkiVarMi('showTur') || $_User->YetkiVarMi('addTur')
            ) { ?>
              <div class="divider"></div>
              <div class="header">Library</div>
            <?php } ?>
            <?php if ($_User->YetkiVarMi('showEmanet') || $_User->YetkiVarMi('addEmanet')) { ?>
              <div class="ui dropdown item">
                Escrow
                <i class="dropdown icon"></i>
                <div class="menu">
                  <?php if ($_User->YetkiVarMi('showEmanet')) { ?><a class="item" href="home.php?Page=ShowEscrow"><i class="eye icon"></i> Show</a><?php } ?>
                  <?php if ($_User->YetkiVarMi('addEmanet')) { ?><a class="item" href="home.php?Page=GiveEscrow"><i class="exchange icon"></i> Give</a><?php } ?>
                </div>
              </div>
            <?php } ?>
            <?php if ($_User->YetkiVarMi('showKitap') || $_User->YetkiVarMi('addKitap')) { ?>
              <div class="ui dropdown item">
                Book
                <i class="dropdown icon"></i>
                <div class="menu">
                  <?php if ($_User->YetkiVarMi('showKitap')) { ?><a class="item" href="home.php?Page=ShowBook"><i class="eye icon"></i> View</a><?php } ?>
                  <?php if ($_User->YetkiVarMi('addKitap')) { ?><a class="item" href="home.php?Page=AddBook"><i class="add icon"></i> Add</a><?php } ?>
                </div>
              </div>
            <?php } ?>
            <?php if ($_User->YetkiVarMi('showYazar') || $_User->YetkiVarMi('addYazar')) { ?>
              <div class="ui dropdown item">
                Author
                <i class="dropdown icon"></i>
                <div class="menu">
                  <?php if ($_User->YetkiVarMi('showYazar')) { ?><a class="item" href="home.php?Page=ShowAuthor"><i class="eye icon"></i> View</a><?php } ?>
                  <?php if ($_User->YetkiVarMi('addYazar')) { ?><a class="item" href="home.php?Page=AddAuthor"><i class="add icon"></i> Add</a><?php } ?>
                </div>
              </div>
            <?php } ?>
            <?php if ($_User->YetkiVarMi('showYayinevi') || $_User->YetkiVarMi('addYayinevi')) { ?>
              <div class="ui dropdown item">
                Publisher
                <i class="dropdown icon"></i>
                <div class="menu">
                  <?php if ($_User->YetkiVarMi('showYayinevi')) { ?><a class="item"><i class="eye icon"></i> View</a><?php } ?>
                  <?php if ($_User->YetkiVarMi('addYayinevi')) { ?><a class="item" href="home.php?Page=AddPublisher"><i class="add icon"></i> Add</a><?php } ?>
                </div>
              </div>
            <?php } ?>
            <?php if ($_User->YetkiVarMi('showTur') || $_User->YetkiVarMi('addTur')) { ?>
              <div class="ui dropdown item">
                Book Type
                <i class="dropdown icon"></i>
                <div class="menu">
                  <?php if ($_User->YetkiVarMi('showTur')) { ?><a class="item"><i class="eye icon"></i> View</a><?php } ?>
                  <?php if ($_User->YetkiVarMi('addTur')) { ?><a class="item" href="home.php?Page=AddType"><i class="add icon"></i> Add</a><?php } ?>
                </div>
              </div>
            <?php } ?>
            <?php if (
              $_User->YetkiVarMi('showKullanici') || $_User->YetkiVarMi('addKullanici') ||
              $_User->YetkiVarMi('showYetki') || $_User->YetkiVarMi('addYetki')
            ) { ?>
              <div class="divider"></div>
              <div class="header">Kullanıcı İşlemleri</div>
            <?php } ?>
            <?php if ($_User->YetkiVarMi('showKullanici') || $_User->YetkiVarMi('addKullanici')) { ?>
              <div class="ui dropdown item">
                Kullanıcı
                <i class="dropdown icon"></i>
                <div class="menu">
                  <?php if ($_User->YetkiVarMi('showKullanici')) { ?><a class="item"><i class="eye icon"></i> View</a><?php } ?>
                  <a class="item"><i class="add icon"></i> Add</a>
                </div>
              </div>
            <?php } ?>
            <?php if ($_User->YetkiVarMi('showYetki') || $_User->YetkiVarMi('addYetki')) { ?>
              <div class="ui dropdown item">
                Yetki
                <i class="dropdown icon"></i>
                <div class="menu">
                  <?php if ($_User->YetkiVarMi('showYetki')) { ?><a class="item"><i class="eye icon"></i> View</a><?php } ?>
                  <a class="item"><i class="add icon"></i> Add</a>
                </div>
              </div>
            <?php } ?>
          </div>
        </div>
      <?php } ?>
      <div class="ui simple dropdown item">
        <img class="ui avatar image" src="assets/images/square-image.png">
        <span><?= $_User->getAdS(); ?></span> <i class="dropdown icon"></i>
        <div class="menu">
          <a class="item" href="#">My Profile</a>
          <div class="divider"></div>
          <div class="header">Account</div>
          <a class="item" href="#">Change Password</a>
          <a class="item" href="logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>
</div>