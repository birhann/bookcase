$(document).ready(function () {
  $('.popup').popup();
  $('.special.cards .image').dimmer({ on: 'hover' });
  $('.ui.dropdown').dropdown();

  $('input[name="adrk_Il"]').change(function () {
    $.post("assets/php/ajax/getHtml.php", { Islem: "getIlce", IlPlaka: $(this).val() }, function (data) {
      $('#Ilceler > .menu').html(data);
      $('#Ilceler > div.text').addClass('default').html('Select District');
    });
  });
  $('.ui.form#AdresKayit').form({
    fields: {
      adrk_Ismi: {
        identifier: 'adrk_Ismi',
        rules: [{
          type: 'empty',
          prompt: 'You left the address name blank.'
        }]
      },
      adrk_Il: {
        identifier: 'adrk_Il',
        rules: [{
          type: 'empty',
          prompt: 'You left the address name blank..'
        }]
      },
      adrk_Ilce: {
        identifier: 'adrk_Ilce',
        rules: [{
          type: 'empty',
          prompt: 'Select District.'
        }]
      },
      adrk_PKodu: {
        identifier: 'adrk_PKodu',
        rules: [{
          type: 'empty',
          prompt: 'Enter the Postal Code.'
        }]
      },
      adrk_Adres: {
        identifier: 'adrk_Adres',
        rules: [{
          type: 'empty',
          prompt: 'Enter the address.'
        }]
      }
    }
  });

  $('.ui.form#KitapEkle').form({
    fields: {
      kitap_ISBN: {
        identifier: 'kitap_ISBN',
        rules: [{
          type: 'empty',
          prompt: 'Enter the ISBN number.'
        }]
      },
      kitap_Ad: {
        identifier: 'kitap_Ad',
        rules: [{
          type: 'empty',
          prompt: 'Enter Book Name.'
        }]
      },
      kitap_Yazar: {
        identifier: 'kitap_Yazar',
        rules: [{
          type: 'empty',
          prompt: 'Please select the author.'
        }]
      },
      kitap_Yayinevi: {
        identifier: 'kitap_Yayinevi',
        rules: [{
          type: 'empty',
          prompt: 'Choose publisher.'
        }]
      },
      kitap_Tur: {
        identifier: 'kitap_Tur',
        rules: [{
          type: 'empty',
          prompt: 'Select Book Type.'
        }]
      },
      kitap_SayfaSayisi: {
        identifier: 'kitap_SayfaSayisi',
        rules: [{
          type: 'empty',
          prompt: 'Enter the Number of Pages.'
        }]
      },
      kitap_YTarih: {
        identifier: 'kitap_YTarih',
        rules: [{
          type: 'empty',
          prompt: 'Enter the publication date.'
        }]
      }
    }
  });
  let Sayfa = (window.location.search).split('=');
  if (Sayfa[Sayfa.length - 1] == 'KitapEkle' || Sayfa[Sayfa.length - 1] == 'YazarEkle') {
    document.getElementById('FotografYukle').onchange = function (evt) {
      var tgt = evt.target || window.event.srcElement,
        files = tgt.files;

      // FileReader support
      if (FileReader && files && files.length) {
        var fr = new FileReader();
        fr.onload = function () {
          document.getElementById('FotografGoster').src = fr.result;
        }
        fr.readAsDataURL(files[0]);
      }

      // Not supported
      else {
        // fallback -- perhaps submit the input to an iframe and temporarily store
        // them on the server until the user's session ends.
      }
    }
  }
  $('.ui.form#TurEkle').form({
    fields: {
      tur_Ismi: {
        identifier: 'tur_Ismi',
        rules: [{
          type: 'empty',
          prompt: 'Please enter the book type.'
        }]
      }
    }
  });
  $('.ui.form#YayineviEkle').form({
    fields: {
      yev_Ismi: {
        identifier: 'yev_Ismi',
        rules: [{
          type: 'empty',
          prompt: 'Please enter publisher.'
        }]
      }
    }
  });
  $('.ui.form#YazarEkle').form({
    fields: {
      yazar_Ad: {
        identifier: 'yazar_Ad',
        rules: [{
          type: 'empty',
          prompt: 'Enter Author Name.'
        }]
      },
      yazar_Soyad: {
        identifier: 'yazar_Soyad',
        rules: [{
          type: 'empty',
          prompt: 'Enter Author Surname'
        }]
      },
      yazar_DTarih: {
        identifier: 'yazar_DTarih',
        rules: [{
          type: 'empty',
          prompt: 'Enter the author\' date of birth.'
        }]
      },
      yazar_DYeri: {
        identifier: 'yazar_DYeri',
        rules: [{
          type: 'empty',
          prompt: 'Enter the author\'s place of birth.'
        }]
      }
    }
  });

  $('.ui.form#EmanetVer').form({
    fields: {
      uyeID: {
        identifier: 'uyeID',
        rules: [{
          type: 'empty',
          prompt: 'Choose User.'
        }]
      },
      kitapID: {
        identifier: 'kitapID',
        rules: [{
          type: 'empty',
          prompt: 'Choose Book'
        }]
      }
    }
  });
  $('.ui.search#UyeAra').search({
    // change search endpoint to a custom endpoint by manipulating apiSettings
    apiSettings: {
      url: 'assets/php/ajax/doSearch.php?Process=User&q={query}'
    },
    type: 'standard',
    onSelect(result, response) {
      $('input[name="uyeID"]').val(result.id);
    }
  });
  $('.ui.search#KitapAra').search({
    // change search endpoint to a custom endpoint by manipulating apiSettings
    apiSettings: {
      url: 'assets/php/ajax/doSearch.php?Process=Book&q={query}'
    },
    type: 'standard',
    onSelect(result, response) {
      $('#KitapID').val(result.id);
    }
  });

  $('.ui.form#KullaniciEkle').form({
    fields: {
      uye_TC: {
        identifier: 'uye_TC',
        rules: [{
          type: 'empty',
          prompt: 'T.C. Kimlik Numaranızı Giriniz.'
        },
        {
          type: 'exactLength[11]',
          prompt: 'Hatalı T.C. Kimlik Numarası girdiniz.'
        }]
      },
      uye_Ad: {
        identifier: 'uye_Ad',
        rules: [{
          type: 'empty',
          prompt: 'Adınızı giriniz.'
        }]
      },
      uye_Soyad: {
        identifier: 'uye_Soyad',
        rules: [{
          type: 'empty',
          prompt: 'Soyadınızı giriniz.'
        }]
      },
      uye_KullaniciAdi: {
        identifier: 'uye_KullaniciAdi',
        rules: [{
          type: 'empty',
          prompt: 'Kullanıcı adınızı giriniz.'
        }]
      },
      uye_EPosta: {
        identifier: 'uye_EPosta',
        rules: [{
          type: 'empty',
          prompt: 'E-Posta adresinizi giriniz.'
        },
        {
          type: 'email',
          prompt: 'E-Posta adresiniz hatalı.'
        }]
      },
      uye_TelNo: {
        identifier: 'uye_TelNo',
        rules: [{
          type: 'empty',
          prompt: 'Telefon numaranızı giriniz.'
        },
        {
          type: 'exactLength[10]',
          prompt: 'Hatalı Telefon Numarası girdiniz. (Örn: 5123456789)'
        }]
      },
      uye_Cinsiyet: {
        identifier: 'uye_Cinsiyet',
        rules: [{
          type: 'empty',
          prompt: 'Cinsiyetinizi seçiniz.'
        }]
      },
      uye_Parola: {
        identifier: 'uye_Parola',
        rules: [{
          type: 'empty',
          prompt: 'Parolanızı giriniz.'
        },
        {
          type: 'minLength[6]',
          prompt: 'Parolanız en az 6 karakterden oluşmalıdır.'
        }]
      },
      uye_ParolaT: {
        identifier: 'uye_ParolaT',
        rules: [{
          type: 'match[uye_Parola]',
          prompt: 'Parolalar uyuşmuyor.'
        }]
      },
      uye_DGun: {
        identifier: 'uye_DGun',
        rules: [{
          type: 'integer[1..31]',
          prompt: 'Hatalı gün girdiniz.'
        }]
      },
      uye_DAy: {
        identifier: 'uye_DAy',
        rules: [{
          type: 'integer[1..12]',
          prompt: 'Hatalı ay girdiniz.'
        }]
      },
      uye_DYil: {
        identifier: 'uye_DYil',
        rules: [{
          type: 'integer[1900..2100]',
          prompt: 'Hatalı yıl girdiniz.'
        }]
      }
    }
  });
});

