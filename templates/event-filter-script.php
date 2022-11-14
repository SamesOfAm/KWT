<script>
    if(document.getElementById('termine') !== null){

        let nodeList = document.querySelectorAll('.ce_accordion');
        let eventsArray = Array.prototype.slice.call(nodeList, 0);
        for(let i = 0; i < eventsArray.length; i++) {
            let dateArray = eventsArray[i].dataset.date.split("/");
            eventsArray[i].dataset.date = dateArray[2].concat(",", dateArray[1], ",", dateArray[0]);
        }
        /* eventsArray.sort(function(a,b){
            return new Date(eventsArray[a]) - new Date(eventsArray[b]);
        }); */


        let allTogglers = document.querySelectorAll('.toggler');
        for(let i = 0; i < allTogglers.length; i++) {
            allTogglers[i].addEventListener("click", function(el){
                let allTrainers = document.querySelectorAll('.trainer');
                for(let j = 0; j < allTrainers.length; j++) {
                    allTrainers[j].children[1].style.height = '0';
                    allTrainers[j].children[0].classList.remove('active');
                }
            })
        }

        function toggleAccordion(toggler) {
            let allTogglers = document.querySelectorAll('.toggler');
            let element = toggler;
            if(!element.classList.contains('active')){
                for(let i = 0; i < allTogglers.length; i++) {
                    if(allTogglers[i].classList.contains('active')){
                        allTogglers[i].classList.remove('active');
                        allTogglers[i].parentNode.children[1].style.height = '0';
                    }
                }
                element.classList.add('active');
                element.nextSibling.style.height = 'auto';
            } else {
                element.classList.remove('active');
                element.nextSibling.style.height = '0';
            }
        }
        (function importLAEK() {
            let request = new XMLHttpRequest();
            request.open('GET', 'https://www.laek-thueringen.de/webservice/veranstaltungen/', true);
            request.onload = function () {
                let data = JSON.parse(this.response);
                let table = document.getElementById('events-list');
                data.forEach(function(event) {
                    let trueDate = event.VON_DATUM.replace("+", ".") + 'Z';
                    let accordion = document.createElement("section");
                    let d = new Date(trueDate);
                    let dataDate = d.getFullYear() + ',' + ("0" + (d.getMonth() + 1)).slice(-2) + ',' + ("0" + d.getDate()).slice(-2);
                    accordion.classList.add('ce_accordionStart');
                    accordion.classList.add('ce_accordion');
                    accordion.classList.add('block');
                    accordion.classList.add('radioChecked');
                    accordion.classList.add('locationChecked');
                    accordion.classList.add('dateChecked');
                    accordion.classList.add('trainer');
                    accordion.classList.add('upcoming');
                    accordion.classList.add('first');
                    accordion.classList.add('last');
                    accordion.classList.add('cal_1');
                    let overviewInfoHeading = '';
                    let overviewInfo = '';
                    if (event.THEMEN !== null) {
                        overviewInfoHeading = 'Themen';
                        overviewInfo = event.THEMEN;
                    } else {
                        overviewInfoHeading = 'KursleiterIn';
                        overviewInfo = event.KURSLEITER;
                    }
                    accordion.setAttribute("data-date", dataDate);
                    accordion.innerHTML = '<div onclick ="toggleAccordion(this);" class="toggler ui-accordion-header ui-corner-top ui-accordion-header-collapsed ui-corner-all ui-state-default ui-accordion-icons" role="tab" aria-selected="false" aria-expanded="false" tabindex="0"><span class="ui-accordion-header-icon ui-icon ui-icon-triangle-1-e"></span><span itemprop="name" class="first-column">&nbsp;' + event.THEMA +  '</span>[nbsp]<span class="date second-column">&nbsp;' + ("0" + d.getDate()).slice(-2) +  '. ' + ("0" + (d.getMonth() + 1)).slice(-2) + '. ' + d.getFullYear() +  '</span><span class="third-column location-for-filter">&nbsp;' + event.ANSPR_ORT + '</span><span class="fourth-column arrow-down"></span></div><div class="accordion ui-accordion-content ui-corner-bottom ui-helper-reset ui-widget-content" role="tabpanel" aria-hidden="true" style="padding-top: 0px; border-top: medium none; padding-bottom: 0px; border-bottom: medium none; overflow: hidden; height: 0px;"><div><div class="event layout_teaser" itemscope="" itemtype="http://schema.org/Event"><div class="event-accordion-detail" itemprop="description"><div class="first-column"><p><strong>' + overviewInfoHeading + '</strong>: ' + overviewInfo + '</p></div><div class="second-column time"><span class="column-head">Zeitraum</span><br><time datetime="' + d + '"itemprop="startDate">' + ("0" + d.getDate()).slice(-2) +  '. ' + ("0" + (d.getMonth() + 1)).slice(-2) + '. ' + d.getFullYear() + '</time></div><div class="third-column"><span class="column-head">Veranstaltungsort</span><br>' + event.ANSPR_ORT + '</div></div><p class="more"><a href="/trainer.html#' + event.VERANSTALTUNGNUMMER +  '" title="" itemprop="url">Weitere Informationen [gt]<span class="invisible">' + event.THEMA +  '</span></a></p></div></div></div>';
                    let inserted = false;
                    if(new Date(eventsArray[eventsArray.length-1].dataset.date) < d) {
                        table.appendChild(accordion);
                        inserted = true;
                    } else if(!inserted) {
                        for (let i = 0; i < eventsArray.length; i++) {

                            let dateString = eventsArray[i].dataset.date + 'T01:00Z';
                            dateString = dateString.replace(",","-");
                            dateString = dateString.replace(",","-");
                            let date = new Date(dateString);
                            if (!inserted && date > d) {

                                table.insertBefore(accordion, table.children[i+1]);
                                eventsArray.splice(i, 0, accordion);
                                inserted = true;
                            }
                        }
                    }
                });
            };
            request.send();
        })();


        let radioTermine = document.getElementById('termine');
        let radioSeminar = document.getElementById('seminar');
        let radioMentoring = document.getElementById('mentoring');
        let radioTrainer = document.getElementById('trainer');

        let allTermine = document.getElementsByClassName('termin');
        let allSeminar = document.getElementsByClassName('seminar');
        let allMentoring = document.getElementsByClassName('mentoring');
        let allTrainer = document.getElementsByClassName('trainer');

        let allEvents = document.getElementsByClassName('ce_accordion');

        let overlay = document.getElementById('overlay');
        let placePickerButton = document.getElementById('place-picker-button');
        let placePicker = document.getElementById('place-picker');
        let datePicker = document.getElementById('date-picker');
        let dateInput = document.getElementById('date-input');
        let allLocationElements = document.getElementsByClassName('location-for-filter');
        let locationSelect = document.getElementById('place-picker');
        let datePickerButton = document.getElementById('date-picker-button');
        let searchFilterButton = document.getElementById('search-filter-button');
        let eventSearchForm = document.getElementById('event-search-form');
        let resetDateInput = document.getElementById('reset-date-input');
        let killTypeFilter = document.querySelector('.kill-filter');

        let allLocations = [];
        for(let i = 0; i < allLocationElements.length; i++) {
            let place = allLocationElements[i].innerHTML;
            if(allLocations.indexOf(place) === -1){
                allLocations.push(allLocationElements[i].innerHTML);
            }
        }
        allLocations.sort();

        placePicker.style.height = allLocations.length * 42 + 180 + 'px';

        for(let i = 0; i < allLocations.length; i++) {
            locationSelect.innerHTML += '<div class="location-option"><label for="' + allLocations[i] + '"><input class="selectable" type="checkbox"  id="' + allLocations[i] + '"><span></span>&nbsp;&nbsp;' + allLocations[i] + '</label></div>';
        }
        locationSelect.innerHTML += '<div class="location-option"><span style="cursor:pointer;" onclick="killLocationFilter();">Filter aufheben</span></div>';
        let allLocationOptions = placePicker.querySelectorAll('input.selectable');

        function filter() {
            for(let i = 0; i < allEvents.length; i++) {
                if (allEvents[i].classList.contains('radioChecked') && allEvents[i].classList.contains('locationChecked') && allEvents[i].classList.contains('dateChecked')) {
                    allEvents[i].style.display = 'block';
                } else {
                    allEvents[i].style.display = 'none';
                }
            }
        }

        function killFilter() {
            radioTermine.checked = false;
            radioSeminar.checked = false;
            radioMentoring.checked = false;
            radioTrainer.checked = false;
            for(let i = 0; i < allEvents.length; i++) {
                allEvents[i].style.display = "block";
            }
        }

        function killLocationFilter() {
            for (let i = 0; i < allLocations.length; i++) {
                allLocationOptions[i].checked = false;
            }
            for(let i = 0; i < allEvents.length; i++) {
                allEvents[i].classList.add('locationChecked');
            }
            filter();
            placePicker.style.top = '45%';
            placePicker.style.opacity = '0';
            placePicker.style.zIndex = '-1';
            overlay.style.zIndex = '0';
            overlay.style.opacity = '0';
        }

        function closePlacePicker() {
            placePicker.style.top = '45%';
            placePicker.style.opacity = '0';
            placePicker.style.zIndex = '-1';
            overlay.style.zIndex = '0';
            overlay.style.opacity = '0';
            let uncheckedCounter = 0;
            for(let i = 0; i < allLocationOptions.length; i++) {
                if (allLocationOptions[i].checked === false) {
                    for(let j = 0; j < allEvents.length; j++) {
                        if(allEvents[j].children[0].children[3].innerHTML === allLocationOptions[i].id){
                            allEvents[j].classList.remove('locationChecked');
                        }
                    }
                    uncheckedCounter++;
                } else {
                    for(let j = 0; j < allEvents.length; j++) {
                        if(allEvents[j].children[0].children[3].innerHTML === allLocationOptions[i].id){
                            allEvents[j].classList.add('locationChecked');
                        }
                    }
                }
            }
            if(uncheckedCounter === allLocationOptions.length) {
                for (let i = 0; i < allEvents.length; i++) {
                    allEvents[i].classList.add('locationChecked');
                }
            }
            filter();
        }

        function closeDatePicker() {
            datePicker.style.top = '45%';
            datePicker.style.opacity = '0';
            datePicker.style.zIndex = '-1';
            overlay.style.zIndex = '0';
            overlay.style.opacity = '0';

            if(dateInput.value === '') {
              for(let i = 0; i < allEvents.length; i++) {
                  allEvents[i].classList.add('dateChecked');
              }
            } else if(dateInput.value.indexOf('-') !== -1) {
                let dateRange = dateInput.value.split(' - ');
                let minDate = Date.parse(dateRange[0]);
                let maxDate = Date.parse(dateRange[1]);
                for(let i = 0; i < allEvents.length; i++) {
                    let currentDate = Date.parse(allEvents[i].attributes['data-date'].value);
                    if ((currentDate > minDate && currentDate < maxDate) || currentDate.getTime() === minDate.getTime() || currentDate.getTime() === maxDate.getTime()) {
                        allEvents[i].classList.add('dateChecked');
                    } else {
                        allEvents[i].classList.remove('dateChecked');
                    }
                }
            } else {
                for(let i = 0; i < allEvents.length; i++) {
                    let currentDate = Date.parse(allEvents[i].attributes['data-date'].value);
                    if (currentDate.getTime() === Date.parse(dateInput.value).getTime()) {
                        allEvents[i].classList.add('dateChecked');
                    } else {
                        allEvents[i].classList.remove('dateChecked');
                    }
                }
            }
            filter();
        }

        resetDateInput.addEventListener('click', function() {
           dateInput.value = '';
        });

        function closeSearchForm() {
            eventSearchForm.style.top = '45%';
            eventSearchForm.style.opacity = '0';
            eventSearchForm.style.zIndex = '-1';
            overlay.style.zIndex = '0';
            overlay.style.opacity = '0';
        }

        placePickerButton.addEventListener('click', function() {
            overlay.style.zIndex = '3';
            overlay.style.opacity = '0.8';
            placePicker.style.zIndex = '4';
            placePicker.style.opacity = '1';
            placePicker.style.top = '50%';
        });

        datePickerButton.addEventListener('click', function() {
            overlay.style.zIndex = '3';
            overlay.style.opacity = '0.8';
            datePicker.style.zIndex = '4';
            datePicker.style.opacity = '1';
            datePicker.style.top = '50%';
        });

        searchFilterButton.addEventListener('click', function() {
            overlay.style.zIndex = '3';
            overlay.style.opacity = '0.8';
            eventSearchForm.style.zIndex = '4';
            eventSearchForm.style.opacity = '1';
            eventSearchForm.style.top = '50%';
        });

        document.getElementById('event-radio-form').onclick = function() {
            if(radioTermine.checked) {
                for (let i = 0; i < allTermine.length; i++) {
                    allTermine[i].classList.add('radioChecked');
                }
            } else {
                for (let i = 0; i < allTermine.length; i++) {
                    allTermine[i].classList.remove('radioChecked');
                }
            }
            if(radioSeminar.checked) {
                for (let i = 0; i < allSeminar.length; i++) {
                    allSeminar[i].classList.add('radioChecked');
                }
            } else {
                for (let i = 0; i < allSeminar.length; i++) {
                    allSeminar[i].classList.remove('radioChecked');
                }
            }
            if(radioMentoring.checked) {
                for (let i = 0; i < allMentoring.length; i++) {
                    allMentoring[i].classList.add('radioChecked');
                }
            } else {
                for (let i = 0; i < allMentoring.length; i++) {
                    allMentoring[i].classList.remove('radioChecked');
                }
            }
            if(radioTrainer.checked) {
                for (let i = 0; i < allTrainer.length; i++) {
                    allTrainer[i].classList.add('radioChecked');
                }
            } else {
                for (let i = 0; i < allTrainer.length; i++) {
                    allTrainer[i].classList.remove('radioChecked');
                }
            }
            if(!radioTermine.checked && !radioSeminar.checked && !radioMentoring.checked && !radioTrainer.checked) {
                for (let i = 0; i < allEvents.length; i++) {
                    allEvents[i].classList.add('radioChecked');
                }
                killTypeFilter.style.color = "#cecece";
            } else {
                killTypeFilter.style.color = "black";
            }
            filter();
        };
    }
</script>
