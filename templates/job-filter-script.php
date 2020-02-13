<script>
    if(document.getElementById('single') !== null){
        let radioSingle = document.getElementById('single');
        let radioGroup = document.getElementById('group');
        let radioMultiple = document.getElementById('multiple');
        let radioMVZ = document.getElementById('mvz');
        let radioHospital = document.getElementById('hospital');

        let allSingle = document.getElementsByClassName('einzelpraxis');
        let allGroup = document.getElementsByClassName('gemeinschaftspraxis');
        let allMultiple = document.getElementsByClassName('praxisgemeinschaft');
        let allMVZ = document.getElementsByClassName('mvz');
        let allHospital = document.getElementsByClassName('krankenhaus');

        let allEvents = document.getElementsByClassName('ce_accordion');

        let overlay = document.getElementById('overlay');
        let placePickerButton = document.getElementById('place-picker-button');
        let placePicker = document.getElementById('place-picker');
        let datePicker = document.getElementById('date-picker');
        let dateInput = document.getElementById('date-input');
        let locationSelect = document.getElementById('place-picker');
        let datePickerButton = document.getElementById('date-picker-button');
        let searchFilterButton = document.getElementById('search-filter-button');
        let eventSearchForm = document.getElementById('event-search-form');
        let resetDateInput = document.getElementById('reset-date-input');
        let killTypeFilter = document.querySelector('.kill-filter');

        let allLocationElements = document.getElementsByClassName('location-for-filter');
        let allLocations = [];
        for(let i = 0; i < allLocationElements.length; i++) {
            let place = allLocationElements[i].innerHTML;
            if(allLocations.indexOf(place) === -1){
                allLocations.push(allLocationElements[i].innerHTML);
            }
        }

        placePicker.style.height = allLocations.length * 42 + 180 + 'px';

        for(let i = 0; i < allLocations.length; i++) {
            locationSelect.innerHTML += '<div class="location-option"><label for="' + allLocations[i] + '"><input class="selectable" type="checkbox" id="' + allLocations[i] + '"><span></span>&nbsp;&nbsp;' + allLocations[i] + '</label></div>';
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
            radioSingle.checked = false;
            radioGroup.checked = false;
            radioMultiple.checked = false;
            radioMVZ.checked = false;
            radioHospital.checked = false;
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
            for(let i = 0; i < allLocationOptions.length; i++) {
                if (allLocationOptions[i].checked === false) {
                    for(let j = 0; j < allEvents.length; j++) {
                        if(allEvents[j].children[0].children[3].innerHTML === allLocationOptions[i].id){
                            allEvents[j].classList.remove('locationChecked');
                        }
                    }
                } else {
                    for(let j = 0; j < allEvents.length; j++) {
                        if(allEvents[j].children[0].children[3].innerHTML === allLocationOptions[i].id){
                            allEvents[j].classList.add('locationChecked');
                        }
                    }
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
            if(radioSingle.checked) {
                for (let i = 0; i < allSingle.length; i++) {
                    allSingle[i].classList.add('radioChecked');
                }
            } else {
                for (let i = 0; i < allSingle.length; i++) {
                    allSingle[i].classList.remove('radioChecked');
                }
            }
            if(radioGroup.checked) {
                for (let i = 0; i < allGroup.length; i++) {
                    allGroup[i].classList.add('radioChecked');
                }
            } else {
                for (let i = 0; i < allGroup.length; i++) {
                    allGroup[i].classList.remove('radioChecked');
                }
            }
            if(radioMultiple.checked) {
                for (let i = 0; i < allMultiple.length; i++) {
                    allMultiple[i].classList.add('radioChecked');
                }
            } else {
                for (let i = 0; i < allMultiple.length; i++) {
                    allMultiple[i].classList.remove('radioChecked');
                }
            }
            if(radioMVZ.checked) {
                for (let i = 0; i < allMVZ.length; i++) {
                    allMVZ[i].classList.add('radioChecked');
                }
            } else {
                for (let i = 0; i < allMVZ.length; i++) {
                    allMVZ[i].classList.remove('radioChecked');
                }
            }
            if(radioHospital.checked) {
                for (let i = 0; i < allHospital.length; i++) {
                    allHospital[i].classList.add('radioChecked');
                }
            } else {
                for (let i = 0; i < allHospital.length; i++) {
                    allHospital[i].classList.remove('radioChecked');
                }
            }
            if(!radioSingle.checked && !radioGroup.checked && !radioMultiple.checked && !radioMVZ.checked && !radioHospital.checked) {
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