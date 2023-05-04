//pop up image on contact page
$(document).ready(function() {
    $('#contact_image').click(function() {
      $('#overlay').fadeIn();
      $('#popup').fadeIn();
    });
  
    $('#close').click(function() {
      $('#overlay').fadeOut();
      $('#popup').fadeOut();
    });
  
    $(window).scroll(function() {
      var scrollTop = $(window).scrollTop();
      var popupOffset = $('#popup').height() / 2;
      $('#popup').css('top', 'calc(50% + ' + (scrollTop - popupOffset) + 'px)');
    });
  });

  //live search for country
  $(function() {
    var options = $('#countrySignUp option').map(function() {
      return {
        value: this.value,
        text: this.text
      };
    }).get();
  
    $('#countryInput').on('input', function() {
      var inputVal = $(this).val();
      var regex = new RegExp(inputVal, 'i');
      var filteredOptions = options.filter(function(option) {
        return regex.test(option.text);
      });
  
      $('#countrySignUp').empty();
      if (filteredOptions.length === 0) {
        $('#countrySignUp').append($('<option>', {
          value: '',
          text: 'No options found'
        }));
      } else {
        $.each(filteredOptions, function(index, option) {
          $('#countrySignUp').append($('<option>', {
            value: option.value,
            text: option.text
          }));
        });
      }
    });
  });

  //search + sort for menu
  $(document).ready(function() {
    // Search function
    $("#searchMenu").on("keyup", function () {
        var value = $(this).val();

        $("table tr").each(function (index) {
            if (index !== 0) {

                $row = $(this);

                var id = $row.find("td:first").text().toLowerCase();

                if (id.indexOf(value) !== 0) {
                    $row.hide();
                } else {
                    $row.show();
                }
            }
        });
    });

    // Sort function
    $('th').each(function (col) {
        $(this).click(function () {
            var sort_direction = $(this).hasClass('sort-asc') ? 'desc' : 'asc';
            var rows = $('table tbody tr').get();
            rows.sort(function (a, b) {
                var A = $(a).children('td').eq(col).text().toUpperCase();
                var B = $(b).children('td').eq(col).text().toUpperCase();
                if (A < B) {
                    return sort_direction === 'asc' ? -1 : 1;
                }
                if (A > B) {
                    return sort_direction === 'asc' ? 1 : -1;
                }
                return 0;
            });
            $.each(rows, function (index, row) {
                $('table tbody').append(row);
            });
            $('th').removeClass('sort-asc sort-desc');
            $(this).addClass('sort-' + sort_direction);
        });
    });
});

//View more list
function showMore() {
  var locationsList = document.getElementById("locList");
  
  for (var i = 1; i < locationsList.children.length; i++) {
    locationsList.children[i].style.visibility = "visible";
  }
  // hide the "View more" button after displaying all the items
  document.getElementById("viewMoreLocBtn").style.display = "none";
}

// update cities when selecting a country
function updateCities() {
    var country = document.getElementById("countrySignUp").value;
    var citySelect = document.getElementById("citySignUp");
    if(country == "India") {
      var cities = ["Mumbai", "Delhi", "Bangalore", "Chennai", "Kolkata"];
    } else if(country == "USA") {
      var cities = ["New York", "Los Angeles", "Chicago", "Houston", "Phoenix"];
    } else if(country == "Canada") {
      var cities = ["Toronto", "Montreal", "Vancouver", "Calgary", "Ottawa"];
    } else if (country == "Romania") {
      var cities = ["Alba Iulia", "Arad", "Cluj-Napoca", "Calarasi", "Suceava"];
    } else if (country == "Greece") {
      var cities = ["Athens", "Halkidiki", "Ecd"];
    }
    citySelect.options.length = 0;
    for(var i = 0; i < cities.length; i++) {
      var option = document.createElement("option");
      option.value = cities[i];
      option.text = cities[i];
      citySelect.add(option);
    }
  }

  function validateSignInForm() {
    var username = document.getElementById("emailLogin").value;
    var password = document.getElementById("passwordLogin").value;

    if (username == "" || !validateEmail(username)) {
        var usernameError = document.getElementById("emailValidationSign");
        usernameError.innerHTML = "Please enter a valid email address!";
        return false;
    }

    if (password == "") {
        var passwordError = document.getElementById("passwordValidationSign");
        passwordError.innerHTML = "Please enter a password!";
        return false;
    }

    return true;
}

function validateEmail(email) {
  var re = /\S+@\S+\.\S+/;
  return re.test(email);
}