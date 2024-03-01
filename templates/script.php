<script>


  if(document.querySelector('.ausgebucht')) {
    const allBookedDays = document.querySelectorAll('.ausgebucht');
    allBookedDays.forEach(day => {
      day.parentElement.querySelector('span').style.opacity = '.3';
      day.parentElement.parentElement.querySelector('input').setAttribute('disabled', 'true');
    })

  }

    if (!Array.prototype.forEach) {
        Array.prototype.forEach = function(callback, thisArg) {
            let T, k;
            if (this === null) {
                throw new TypeError(' this is null or not defined');
            }
            let O = Object(this);
            let len = O.length >>> 0;
            if (typeof callback !== "function") {
                throw new TypeError(callback + ' is not a function');
            }
            if (arguments.length > 1) {
                T = thisArg;
            }
            k = 0;
            while (k < len) {

                let kValue;
                if (k in O) {
                    kValue = O[k];
                    callback.call(T, kValue, k, O);
                }
                k++;
            }
        };
    }

    jQuery(document).ready(function(){
        document.querySelector('.to-top-button').hide();
        jQuery(window).scroll(function(){
            var value=400;
            var scrolling=jQuery(window).scrollTop();
            if(scrolling>value){
                jQuery('.to-top-button').fadeIn();
            } else{
                jQuery('.to-top-button').fadeOut();
            }
        });
        jQuery('.to-top-button').click(function(){
            jQuery('html, body').animate({scrollTop:'0px'},800);
            return !1;
        });
    });
    let footerMenuTrigger = document.querySelector('.footer-navigation-right').children[1].children[1].children[0];
    footerMenuTrigger.children[0].innerHTML = "Hausarzt werden";
    footerMenuTrigger.removeAttribute("href");
    footerMenuTrigger.style.cursor = 'pointer';
    footerMenuTrigger.id = 'footerMenuTrigger';
    jQuery('#footerMenuTrigger').click(function(){
        jQuery('#mobile-menu-25-trigger').click();
    });

    if (document.querySelector('.job-slider') !== null) {
        if (document.querySelector('.job-slider').querySelector('.empty') !== null) {
            document.querySelector('.job-slider').querySelector('.empty').innerHTML = 'Aktuell sind leider keine Stellen zu vergeben';
            document.querySelector('.slider-menu').style.display = 'none';
        }
    }

    (function importLAEK() {
        let request = new XMLHttpRequest();
        request.open('GET', 'https://www.laek-thueringen.de/webservice/veranstaltungen/', true);
        request.onload = function () {
            let data = JSON.parse(this.response);
            data.forEach(function(event) {
                let trueDate = event.VON_DATUM.replace("+", ".") + 'Z';
                let d = new Date(trueDate);
                let themen = '';
                if(event.THEMEN !== null) {
                    themen = event.THEMEN;
                } else {
                    themen = event.KURSLEITER;
                }
                let eventsParent = document.getElementById('events-home');
                if(eventsParent !== null) {
                    let allShownEvents = eventsParent.children;
                    for(let i = 0; i < allShownEvents.length; i++) {
                        let checkedEventsDate = new Date(allShownEvents[i].querySelector('.time').children[0].dateTime);
                        if(d < checkedEventsDate) {
                            let newEvent = document.createElement('div');
                            newEvent.classList.add('event');
                            newEvent.classList.add('layout_teaser');
                            newEvent.classList.add('trainer');
                            newEvent.classList.add('upcoming');
                            newEvent.innerHTML =
                                '<div class="shadow-circle-wrap">' +
                                '<div class="shadow-circle"></div>' +
                                '</div>\n' +
                                '<div class="type-circle">' +
                                '<span class="type-circle-text"></span>' +
                                '</div>\n' +
                                '<p class="time"><time datetime="' + trueDate + '" itemprop="startDate">' + ("0" + d.getDate()).slice(-2) +  '. ' + ("0" + (d.getMonth() + 1)).slice(-2) + '. ' + d.getFullYear() + '</time></p>' +
                                '<h5 itemprop="name"><a href="/trainer.html#' + event.VERANSTALTUNGNUMMER +  '" title="'+ event.THEMA + '" itemprop="url">' + event.THEMA + '</a></h5>' +
                                '<div class="ce_text block" itemprop="description">' +
                                '<p><strong>Themen</strong>: ' + themen + ' </p>' +
                                '<span class="more-home"><a href="/trainer.html#' + event.VERANSTALTUNGNUMMER +  '" title="Den Artikel lesen: ' + event.THEMA + '" itemprop="url">Weiterlesen …<span class="invisible">' + event.THEMA + '</span></a></span>' +
                                '</div>';
                            eventsParent.insertBefore(newEvent, allShownEvents[i]);
                            eventsParent.removeChild(allShownEvents[allShownEvents.length-1]);
                            break;
                        }
                    }
                }
            })
        };
        request.send();
    })();

  /*  const seminarCheck = document.querySelectorAll(".seminarday .checkbox");
    //console.log(seminarCheck);
    const maxCheck = 4;
    for (let i = 0; i < seminarCheck.length; i++) {
        seminarCheck[i].onclick = seminarDayCheck;

        function seminarDayCheck () {
            const checkboxCheck = document.querySelectorAll(".checkbox:checked");
           // console.log(checkboxCheck);
            if (checkboxCheck.length > maxCheck ) {
                return false;
            }
        }
    }*/
    const div = document.createElement("div");
    div.classList.add('meldung')
    div.innerHTML = "Bitte wählen Sie maximal 4 Seminartage aus.";
    div.style.opacity = '0'

    const seminarCheck = document.querySelectorAll(".seminarday .checkbox");
    const maxCheck = 4;
    const checkboxCheck = document.querySelectorAll(".checkbox:checked");
    seminarCheck.forEach(checkbox => {
    checkbox.addEventListener('click', function (e) {
       // console.log(e.target)  ;
        //console.log(checkbox);
        const checkboxCheck = document.querySelectorAll(".checkbox:checked");
        // console.log(checkboxCheck.length);
            if (checkboxCheck.length > maxCheck ) {
                e.target.parentElement.appendChild(div);
               // console.log(  e.target.parentElement.appendChild(div))

                setTimeout(function() {
                    document.querySelector('.meldung').style.opacity = '1';
                }, 100)
                setTimeout(function() {
                    document.querySelector('.meldung').style.opacity = '0';
                }, 5000);
                this.checked = false;
            } else if(checkboxCheck.length < maxCheck && document.querySelector('.meldung')) {
                document.querySelector('.meldung').style.opacity = '0'
            }
       })

    })


</script>
