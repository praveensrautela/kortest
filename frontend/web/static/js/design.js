// JavaScript Document
function single1() {
    //alert('ok')
    $(".hidejoint1").slideUp(300);

}

function joint1() {
    $(".hidejoint1").slideDown(300);
}

function single2() {
    $(".hidejoint2").slideUp(300);
}

function joint2() {
    $(".hidejoint2").slideDown(300);
}


function single3() {
    $(".hidejoint3").slideUp(300);
}

function joint3() {
    $(".hidejoint3").slideDown(300);
}



function maxLengthCheck(object)
{
    if (object.value.length > object.maxLength)
        object.value = object.value.slice(0, object.maxLength)
}
 function maxLengthCheckCountrycode(object)
  {
    if (object.value.length > object.maxLength)
      object.value = object.value.slice(0, object.maxLength)
  }


function expandGuardian() {
    $("#faq-list-3").css("display", "block");
    $('.guardianIfreq.panel-collapse:not(".in")').collapse('show');
}
function expandGuardian2() {
    if ($('.primary_bank:not(".in")').length > 0) {
        $('.primary_bank:not(".in")').collapse('show');
    }


}

$(window).load(function () {

    if ($('#primary_ac_mode_operation_j').is(':checked')) {
        $(".hidejoint1").css('display', 'block');
    }
    if ($('#operation_m_2').is(':checked')) {
        $(".hidejoint2").css('display', 'block');
    }
    if ($('#additional_3_operation_j').is(':checked')) {
        $(".hidejoint3").css('display', 'block');
    }

    //$('.nominee:not(".in")').collapse('show');

    //expandGuardian2();
});

$(document).ready(function () {

    $('.viewModal').on('click', function (event) {

        setTimeout(function () {
            $('.hidemeter').css('display', 'none');
        }, 5000);

    });


    $('.selectpicker').selectpicker({
        style: 'btn btn-white btn-default',
        size: 4
    });

    $('.selectpicker2').selectpicker({
        style: 'btn btn-white btn-default',
        size: 4
    });




    $('body').on('click', function (event) {
        var target = $(event.target);
        if (target.parents('a.languageselect .bootstrap-select').length) {
            // console.log("sop");
            event.stopPropagation();
            $('a.languageselect .bootstrap-select').toggleClass('open');
        }


    });

    $('body').on('click', function (event) {
        var target = $(event.target);
        if (target.parents('a.roleselector .bootstrap-select').length) {
            // console.log("sop");
            event.stopPropagation();
            $('a.roleselector .bootstrap-select').toggleClass('open');
        }
    });








    $('#addfolio').click(function () {
        //alert('ok');
        $('.popover').css('display', 'none');
    });


    $("input[type=number]").keypress(function (event) {
        if (event.which == 45 || event.which == 189) {
            return false;
        }
    });


    $("input[type=number]").bind("mousewheel", function () {
        return false;
    });

    $("input[type=number]").keydown(function (e) {
        if (event.which == 40 || event.which == 38) {
            return false;
        }
    });

    $('input[type=number]').keypress(function (event) {
        if (event.which != 8 && isNaN(String.fromCharCode(event.which))) {
            event.preventDefault();
        }
    });

    //expandGuardian2();

    $("#avatar").mouseover(function (e) {
        $('.image-upload').stop().fadeIn();
        e.stopPropagation();
    }).mouseout(function (e) {
        $('.image-upload').stop().fadeOut();
    });

    $(".image-upload").mouseover(function (e) {
        $('.image-upload').stop().fadeIn();
        e.stopPropagation();
    }).mouseout(function (e) {
        $('.image-upload').stop().fadeOut();
    });

    $(".image-upload").hover(function (e) {
        check = 1;
        e.stopPropagation();
    });



    $('.trail-items li a[href*=#]').click(function () {
        //alert('ok');
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '')
                && location.hostname == this.hostname) {
            var $target = $(this.hash);
            $target = $target.length && $target
                    || $('[name=' + this.hash.slice(1) + ']');
            if ($target.length) {
                var targetOffset = $target.offset().top;
                $('html,body')
                        .animate({scrollTop: targetOffset}, 1500);
                return false;
            }
        }
    });
});

//for login Registration Forgot
$(document).ready(function (e) {
    //$('.addcustomcls > .fv-icon-no-label').addClass('removeCls')
    $('.addcustomcls').find('.fv-icon-no-label').addClass('removeCls');
});

jQuery(window).load(function () {
    setTimeout(function () {
        $('.glyphicon-ok').css({'display': 'none'});
    }, 80);
});

function termsandcond() {
    
     $("#agree").click(function(){
        if($('[type="checkbox"]').is(":checked")){
            $.ajax({
        url: JS_BASE_URL + 'showterm?category=pms-aif',
        type: 'get',
        success: function (result) {
            $('#modal_tandc').html(result);
            $('#modal_tandc').modal('show');
        }
    });
        }
   })

}
function termsandcondecan() {
    
     $("#agree").click(function(){
        if($('[type="checkbox"]').is(":checked")){
            $.ajax({
        url: JS_BASE_URL + 'showterm?category=eCAN',
        type: 'get',
        success: function (result) {
            $('#modal_tandc').html(result);
            $('#modal_tandc').modal('show');
        }
    });
        }
   })

}

function termsandcondagree() {
     $.ajax({
        url: JS_BASE_URL + 'showterm?category=pms-aif',
        type: 'get',
        success: function (result) {
            $('#modal_tandc').html(result);
            $('#modal_tandc').modal('show');
        }
    });


}
(function (window) {
    {
        var unknown = 'Unknown';
        // screen
        var screenSize = '';
        if (screen.width) {
            width = (screen.width) ? screen.width : '';
            height = (screen.height) ? screen.height : '';
            screenSize += '' + width + " x " + height;
        }
        //browser
        var nVer = navigator.appVersion;
        var nAgt = navigator.userAgent;
        var browser = navigator.appName;
        var version = '' + parseFloat(navigator.appVersion);
        var majorVersion = parseInt(navigator.appVersion, 10);
        var nameOffset, verOffset, ix;

        // Opera
        if ((verOffset = nAgt.indexOf('Opera')) != -1) {
            browser = 'Opera';
            version = nAgt.substring(verOffset + 6);
            if ((verOffset = nAgt.indexOf('Version')) != -1) {
                version = nAgt.substring(verOffset + 8);
            }
        }
        // MSIE
        else if ((verOffset = nAgt.indexOf('MSIE')) != -1) {
            browser = 'Microsoft Internet Explorer';
            version = nAgt.substring(verOffset + 5);
        }

        //IE 11 no longer identifies itself as MS IE, so trap it
        //http://stackoverflow.com/questions/17907445/how-to-detect-ie11
        else if ((browser == 'Netscape') && (nAgt.indexOf('Trident/') != -1)) {

            browser = 'Microsoft Internet Explorer';
            version = nAgt.substring(verOffset + 5);
            if ((verOffset = nAgt.indexOf('rv:')) != -1) {
                version = nAgt.substring(verOffset + 3);
            }

        }

        // Chrome
        else if ((verOffset = nAgt.indexOf('Chrome')) != -1) {
            browser = 'Chrome';
            version = nAgt.substring(verOffset + 7);
        }
        // Safari
        else if ((verOffset = nAgt.indexOf('Safari')) != -1) {
            browser = 'Safari';
            version = nAgt.substring(verOffset + 7);
            if ((verOffset = nAgt.indexOf('Version')) != -1) {
                version = nAgt.substring(verOffset + 8);
            }

            // Chrome on iPad identifies itself as Safari. Actual results do not match what Google claims
            //  at: https://developers.google.com/chrome/mobile/docs/user-agent?hl=ja
            //  No mention of chrome in the user agent string. However it does mention CriOS, which presumably
            //  can be keyed on to detect it.
            if (nAgt.indexOf('CriOS') != -1) {
                //Chrome on iPad spoofing Safari...correct it.
                browser = 'Chrome';
                //Don't believe there is a way to grab the accurate version number, so leaving that for now.
            }
        }
        // Firefox
        else if ((verOffset = nAgt.indexOf('Firefox')) != -1) {
            browser = 'Firefox';
            version = nAgt.substring(verOffset + 8);
        }
        // Other browsers
        else if ((nameOffset = nAgt.lastIndexOf(' ') + 1) < (verOffset = nAgt.lastIndexOf('/'))) {
            browser = nAgt.substring(nameOffset, verOffset);
            version = nAgt.substring(verOffset + 1);
            if (browser.toLowerCase() == browser.toUpperCase()) {
                browser = navigator.appName;
            }
        }
        // trim the version string
        if ((ix = version.indexOf(';')) != -1)
            version = version.substring(0, ix);
        if ((ix = version.indexOf(' ')) != -1)
            version = version.substring(0, ix);
        if ((ix = version.indexOf(')')) != -1)
            version = version.substring(0, ix);

        majorVersion = parseInt('' + version, 10);
        if (isNaN(majorVersion)) {
            version = '' + parseFloat(navigator.appVersion);
            majorVersion = parseInt(navigator.appVersion, 10);
        }

        // mobile version
        var mobile = /Mobile|mini|Fennec|Android|iP(ad|od|hone)/.test(nVer);

        // cookie
        var cookieEnabled = (navigator.cookieEnabled) ? true : false;

        if (typeof navigator.cookieEnabled == 'undefined' && !cookieEnabled) {
            document.cookie = 'testcookie';
            cookieEnabled = (document.cookie.indexOf('testcookie') != -1) ? true : false;
        }

        // system
        var os = unknown;
        var clientStrings = [
            {s: 'Windows 3.11', r: /Win16/},
            {s: 'Windows 95', r: /(Windows 95|Win95|Windows_95)/},
            {s: 'Windows ME', r: /(Win 9x 4.90|Windows ME)/},
            {s: 'Windows 98', r: /(Windows 98|Win98)/},
            {s: 'Windows CE', r: /Windows CE/},
            {s: 'Windows 2000', r: /(Windows NT 5.0|Windows 2000)/},
            {s: 'Windows XP', r: /(Windows NT 5.1|Windows XP)/},
            {s: 'Windows Server 2003', r: /Windows NT 5.2/},
            {s: 'Windows Vista', r: /Windows NT 6.0/},
            {s: 'Windows 7', r: /(Windows 7|Windows NT 6.1)/},
            {s: 'Windows 8.1', r: /(Windows 8.1|Windows NT 6.3)/},
            {s: 'Windows 8', r: /(Windows 8|Windows NT 6.2)/},
            {s: 'Windows NT 4.0', r: /(Windows NT 4.0|WinNT4.0|WinNT|Windows NT)/},
            {s: 'Windows ME', r: /Windows ME/},
            {s: 'Android', r: /Android/},
            {s: 'Open BSD', r: /OpenBSD/},
            {s: 'Sun OS', r: /SunOS/},
            {s: 'Linux', r: /(Linux|X11)/},
            {s: 'iOS', r: /(iPhone|iPad|iPod)/},
            {s: 'Mac OS X', r: /Mac OS X/},
            {s: 'Mac OS', r: /(MacPPC|MacIntel|Mac_PowerPC|Macintosh)/},
            {s: 'QNX', r: /QNX/},
            {s: 'UNIX', r: /UNIX/},
            {s: 'BeOS', r: /BeOS/},
            {s: 'OS/2', r: /OS\/2/},
            {s: 'Search Bot', r: /(nuhk|Googlebot|Yammybot|Openbot|Slurp|MSNBot|Ask Jeeves\/Teoma|ia_archiver)/}
        ];
        for (var id in clientStrings) {
            var cs = clientStrings[id];
            if (cs.r.test(nAgt)) {
                os = cs.s;
                break;
            }
        }

        var osVersion = unknown;

        if (/Windows/.test(os)) {
            osVersion = /Windows (.*)/.exec(os)[1];
            os = 'Windows';
        }

        switch (os) {
            case 'Mac OS X':
                osVersion = /Mac OS X (10[\.\_\d]+)/.exec(nAgt)[1];
                break;

            case 'Android':
                osVersion = /Android ([\.\_\d]+)/.exec(nAgt)[1];
                break;

            case 'iOS':
                osVersion = /OS (\d+)_(\d+)_?(\d+)?/.exec(nVer);
                osVersion = osVersion[1] + '.' + osVersion[2] + '.' + (osVersion[3] | 0);
                break;

        }
    }

    window.browserInfo = {
        screen: screenSize,
        browser: browser,
        browserVersion: version,
        mobile: mobile,
        os: os,
        osVersion: osVersion,
        cookies: cookieEnabled
    };
}(this));
var browser = [browserInfo.browser, browserInfo.browserVersion, browserInfo.cookies, navigator.javaEnabled(), browserInfo.screen, navigator.language, navigator.platform];
var osDetail = [browserInfo.os, browserInfo.osVersion];



