var ddd = new Date().toLocaleString('en-US', {year: '2-digit', month: '2-digit', day: '2-digit'});

var calendars = bulmaCalendar.attach('#kp-datepicker', {
  show: true,
  displayMode: 'default',
  showFooter: false,
  showHeader: false,
  startDate: new Date(),
  minDate: ddd,
  maxDate: '12/31/2099'
});


function getParameterByName(name, url) {
  if (!url) url = window.location.href;
  name = name.replace(/[\[\]]/g, '\\$&');
  var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
    results = regex.exec(url);
  if (!results) return null;
  if (!results[2]) return '';
  return decodeURIComponent(results[2].replace(/\+/g, ' '));
}

const urlParams = new URLSearchParams(window.location.search);
if (getParameterByName('error')) {
  errorAlert('form', getParameterByName('error'))

}


function disabledSudmitChecker(elem, selectors, checkboxes, submit) {
  let form = elem.closest('form');
  let isSelectorActive = false;
  let isCheckboxActive = true;

  if (submit) {
    submit = form.querySelector(submit);

  } else {
    submit = form.querySelector('button[type=submit]');
  }

  if (checkboxes) {
    isCheckboxActive = false;
    for (let item in checkboxes) {
      item = document.querySelector(checkboxes[item]);
      if (item.checked) {
        isCheckboxActive = true;
      } else {
        isCheckboxActive = false;
        break;
      }
    }
  }

  for (let item in selectors) {
    item = document.querySelector(selectors[item]);
    if (item.value.length >= 1) {
      isSelectorActive = true;
    } else {
      isSelectorActive = false;
      break
    }
  }

  if (isSelectorActive && isCheckboxActive) {
    submit.classList.remove('disabled');
    submit.disabled = false;
  } else {
    submit.classList.add('disabled');
    submit.disabled = true;
  }
}

function showPassword() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}


// $('.go-back').on('click', function () {
//   window.history.back();
// });

$('.product-item').on('click', function (event) {
  let target = $(event.target);

  let input = target.find('input[type=hidden]')
  let isActive = !target.hasClass('active');
  target.toggleClass('active');

  if (target.attr('id') === 'vegan') {
    $('.product-item:not(#vegan)').each(function (key, item) {
      $(item).removeClass('active');
    })
  } else if (target.attr('id') !== 'vegan') {
    $('#vegan').removeClass('active');
  }

  if (isActive) {
    input.attr('value', target.id);
  } else {
    input.attr('value', '');
  }
  let productItem = $('.product-item.active');
  let statusText = '';
  if (productItem.length >= 1) {
    statusText = 'Ich esse';
    productItem.each((key, item) => {
      if (key >= 1) {
        statusText += ' und ' + item.dataset.text;
      } else {
        statusText += ' ' + item.dataset.text;
      }
    });
    statusText += '.';
  }


  let disableSubmit = true
  $('.product-item').each(function (key, item) {
    if ($(item).hasClass('active')) {
      disableSubmit = false
    }
  });
  if (disableSubmit) {
    $(".submit-btn").addClass("disabled");
    $(".submit-btn").attr("disabled", "disabled");
  } else {
    $(".submit-btn").removeClass("disabled");
    $(".submit-btn").attr("disabled", null);
  }


  $('form.set-product-form .change-text').text(statusText);
});


if ($(window).width() > 1024) {
  $('.product-item').mouseover(function () {

    $(this).addClass('hover');

  })
    .mouseout(function () {
      $(this).removeClass('hover');
    });
}

// NEW JS
function toggleActiveFormItem(event) {
  let target = $(event.currentTarget);
  // $(target.parent('.option-wrapper').find('.set-item')).each((key, item) => {
  //   item = $(item);
  //   if (item.hasClass('active') && item != target) {
  //     item.removeClass('active');
  //   }
  // });
  target.toggleClass('active');
  checkBox = target.find('input');
  checkBox.prop("checked", !checkBox.prop("checked"));
  return false;
};


$('.often-item').on('click', function (event) {
  this.classList.toggle('active');
  event.preventDefault();
  this.closest('form').submit();
})

$('.often-item').mouseover(function () {
  let hover;

  $('.often-item').each((key, item) => {
    if (item.innerText === this.innerText) {
      hover = true
    }
    if (hover) {
      $(item).addClass('active');
    }
  })
  hover = false;
})
  .mouseout(function () {
    $('.often-item').each((key, item) => {
      $(item).removeClass('active');
    })
  });


$('.set-feeling-form label.set-item').on('click', toggleActiveFormItem);


document.querySelectorAll('.cart-item .delete').forEach((item, key) => {
  item.addEventListener('click', function (event) {
    target = event.currentTarget;
    target.closest('.cart-item').remove();
    let cartJson = getCookie('items');
    let cartObj = JSON.parse(cartJson);
    let itemKey = target.dataset.name.split(' ').join('+');
    delete cartObj[itemKey];

    console.log(itemKey);
    console.log(cartObj);
    setCookie("items", JSON.stringify(cartObj));
    totalProcessing()
  })
})


function totalProcessing(promocode) {
  // let promocode = getCookie('promocode_value');
  let total = 0;
  document.querySelectorAll(".cart-item").forEach(function (item) {
    total = +total + +item.dataset.price;
  })

  if (promocode) {
    let discount = total / 100 * promocode;
    total = total - discount
  }
  total = total.toFixed(2);
  if (total > 0) {
    document.querySelector('.total .price span').innerHTML = total;
    document.querySelector('.submit-btn span').innerHTML = total + " € bezahlen"
  } else {
    document.querySelector('.total .price span').innerHTML = total;
    document.querySelector('.submit-btn span').innerHTML = "Weiter ohne Zahlung ",
      document.querySelector('.submit-btn').type = false;
    document.querySelector('.submit-btn').onclick = () => {
      //todo change in production
      window.location.href = "/online-registration/finish"
    }

  }
}


$('.datepicker  button').on("click", function (e) {
  e.preventDefault();
});


document.querySelector(".payment.submit-btn").addEventListener("click", function () {
  var form = new FormData();
  form.append("cart", getCookie('items'));
  form.append("promocode_discount", getCookie('promocode_discount'));
  this.querySelector("span").innerHTML = "Warten Sie bitte";
  var settings = {
    "async": true,
    "crossDomain": true,
    "url": "/wp-admin/admin-ajax.php?action=kp_payment",
    "method": "POST",
    "headers": {},
    "processData": false,
    "contentType": false,
    "mimeType": "multipart/form-data",
    "data": form
  }

  $.ajax(settings).done(function (response) {
    let responseObj = JSON.parse(response)
    console.dir(responseObj)
    var stripe = Stripe('pk_test_3EB27h7ZhHJkfY9rg2H6Nkr400NTA703E5');
    stripe.redirectToCheckout({
      sessionId: responseObj.id
    }).then(function (result) {
    });
  });
})


document.querySelector('form.promocode-wrapper').addEventListener("submit", function (event) {
  event.preventDefault();
  let target = event.currentTarget;
  let input = target.querySelector('.payment-input.promocode')
  var form = new FormData();

  form.append("promocode", input.value);
  var settings = {
    "async": true,
    "crossDomain": true,
    "url": "/wp-admin/admin-ajax.php?action=kp_check_promocode",
    "method": "POST",
    "headers": {},
    "processData": false,
    "contentType": false,
    "mimeType": "multipart/form-data",
    "data": form
  }

  $.ajax(settings).done(function (response) {
    if (response !== "0") {
      setCookie("promocode_discount", response);
      totalProcessing(response)
    } else {
      console.log(response)

      errorAlert(".promocode-wrapper", 'Ungültiger Promotion-Code')
    }
  });

});

function errorAlert(selector, text) {

  let alert = document.createElement("div");
  alert.classList.add("error-alert");
  alert.innerHTML = text;
  console.log(alert)

  let element = document.querySelector(selector).appendChild(alert);
  setTimeout(function () {
    element.remove()
  }, 4000)

}
