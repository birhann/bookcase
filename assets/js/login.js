$(document).ready(function () {
  $('.ui.dropdown').dropdown();
  $('#KOAKABUL').on("click", function () {
    $('input[name="i_USozlesme"]').prop('checked', true);
  });
  $('.ui.form').form({
    fields: {
      kAd: {
        identifier: 'kAd',
        rules: [{
          type: 'empty',
          prompt: 'Enter Username / E-Mail or Phone.'
        }]
      },
      kParola: {
        identifier: 'kParola',
        rules: [{
          type: 'empty',
          prompt: 'Enter your password.'
        }]
      }
    }
  });
  $('.ui.form#KaydolF').form({
    fields: {
      i_Ad: {
        identifier: 'i_Ad',
        rules: [{
          type: 'empty',
          prompt: 'Enter your name.'
        }]
      },
      i_Soyad: {
        identifier: 'i_Soyad',
        rules: [{
          type: 'empty',
          prompt: 'Enter your last name.'
        }]
      },
      i_KullaniciAdi: {
        identifier: 'i_KullaniciAdi',
        rules: [{
          type: 'empty',
          prompt: 'Kullanıcı adınızı giriniz.'
        }]
      },
      i_EPosta: {
        identifier: 'i_EPosta',
        rules: [{
          type: 'empty',
          prompt: 'Enter your e-mail address.'
        },
        {
          type: 'email',
          prompt: 'Your e-mail address is incorrect.'
        }]
      },
      i_TelNo: {
        identifier: 'i_TelNo',
        rules: [{
          type: 'empty',
          prompt: 'Enter your phone number.'
        },
        {
          type: 'exactLength[10]',
          prompt: 'You entered the wrong phone number. (Ex: 5398765432)'
        }]
      },
      i_Cinsiyet: {
        identifier: 'i_Cinsiyet',
        rules: [{
          type: 'empty',
          prompt: 'Choose your gender.'
        }]
      },
      i_Parola: {
        identifier: 'i_Parola',
        rules: [{
          type: 'empty',
          prompt: 'Enter your password.'
        },
        {
          type: 'minLength[6]',
          prompt: 'Your password must be at least 6 characters.'
        }]
      },
      i_ParolaT: {
        identifier: 'i_ParolaT',
        rules: [{
          type: 'match[i_Parola]',
          prompt: 'Parolalar uyuşmuyor.'
        }]
      },
      i_DGun: {
        identifier: 'i_DGun',
        rules: [{
          type: 'integer[1..31]',
          prompt: 'You entered the wrong day.'
        }]
      },
      i_DAy: {
        identifier: 'i_DAy',
        rules: [{
          type: 'integer[1..12]',
          prompt: 'You entered the wrong month.'
        }]
      },
      i_DYil: {
        identifier: 'i_DYil',
        rules: [{
          type: 'integer[1900..2100]',
          prompt: 'You entered the wrong year.'
        }]
      },
      i_USozlesme: {
        identifier: 'i_USozlesme',
        rules: [{
          type: 'checked',
          prompt: 'You must read and approve the membership agreement.'
        }]
      }
    }
  });

  $('.ui.form#ResetPasswordF').form({
    fields: {
      rp_eMail: {
        identifier: 'rp_eMail',
        rules: [{
          type: 'empty',
          prompt: 'Enter your e-mail address.'
        },
        {
          type: 'email',
          prompt: 'Your e-mail address is incorrect.'
        }]
      }
    }
  });
});
