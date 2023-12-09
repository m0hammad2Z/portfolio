let fontType = document.getElementById('font-type');
let fontColor = document.getElementById('font-color');
let primaryColor = document.getElementById('primary-color');
let secondaryColor = document.getElementById('secondary-color');
let backgroundColor = document.getElementById('background-color');

window.onload = function() {
    $.ajax({
        type: 'GET',
        url: 'themeHandling.php', 
        contentType: 'application/json',
        success: function(response) {
            response = JSON.parse(response);
            fontType.value = response['fontType'];
            fontColor.value = response['fontColor'];
            backgroundColor.value = response['backgroundColor'];
            primaryColor.value = response['primaryColor'];
            secondaryColor.value = response['secondaryColor'];

            document.body.style.fontFamily = fontType.value;
            document.body.style.color = fontColor.value;
            document.body.style.backgroundColor = backgroundColor.value;
            document.documentElement.style.setProperty('--blue', primaryColor.value);
            document.documentElement.style.setProperty('--divider-color', secondaryColor.value);
        },
        error: function(error) {
            console.error(error);
        }
    });
}

function request(dom){
    $.ajax({
        type: 'POST',
        url: 'themeHandling.php', 
        contentType: 'application/json',
        data: JSON.stringify({
            fontType: fontType.value,
            fontColor: fontColor.value,
            backgroundColor: backgroundColor.value,
            primaryColor: primaryColor.value,
            secondaryColor: secondaryColor.value
        }),

        success: function(response) {
            response = JSON.parse(response);
            console.log(response['status']);

            if (response['status'] == 'success') {
                document.body.style.fontFamily = fontType.value;
                document.body.style.color = fontColor.value;
                document.body.style.backgroundColor = backgroundColor.value;
                document.documentElement.style.setProperty('--blue', primaryColor.value);
                document.documentElement.style.setProperty('--divider-color', secondaryColor.value);
                
            } else {
                console.log('error');
            }

        },
        error: function(error) {
            console.error(error);
        }
    });
}


fontType.addEventListener('change', function() {
   request();
});

fontColor.addEventListener('change', function() {
    request();
});

primaryColor.addEventListener('change', function() {
    request();
});

secondaryColor.addEventListener('change', function() {
    request();
});

backgroundColor.addEventListener('change', function() {
    request();
});