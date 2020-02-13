<div class="ce_text block">
    <div class="event-filter">
        <div class="filter-headline">
            <span>Filter</span>
        </div>
        <div class="filter-radio">
            <form id="event-radio-form">
                <div class="radio-option">
                    <label for="termine">
                        <input type="checkbox" id="termine">
                        <span></span>
                        &nbsp;&nbsp;Termine
                    </label>
                </div>
                <div class="radio-option">
                    <label for="seminar">
                        <input type="checkbox" id="seminar">
                        <span></span>
                        &nbsp;&nbsp;Seminarprogramm
                    </label>
                </div>
                <div class="radio-option">
                    <label for="mentoring">
                        <input type="checkbox" id="mentoring">
                        <span></span>
                        &nbsp;&nbsp;Mentoring
                    </label>
                </div>
                <div class="radio-option">
                    <label for="trainer">
                        <input type="checkbox" id="trainer">
                        <span></span>
                        &nbsp;&nbsp;Train the Trainer
                    </label>
                </div>
                <div class="radio-option kill-filter" style="cursor:pointer;color:#cecece">
                    <span onclick="killFilter();">Filter aufheben</span>
                </div>
            </form>
        </div>
        <div class="filter-buttons">
            <div class="date-filter" id="date-picker-button">
                <span class="date-icon"></span>
                <span class="filter-button-text">&nbsp;&nbsp;Datum</span>
            </div>
            <form id="date-picker">
                <p class="location-filter-headline">Nach Datum filtern</p>
                <input type="text" class="datepicker-here" data-range="true" data-language="de" data-position="top center" id="date-input" placeholder="Alle Termine anzeigen">
                <label for="date-input"><img class="calendar-icon" src="files/assets/layout/calendar-black.svg"></label>
                <p id="reset-date-input">Zurücksetzen</p>
                <button id="close-date-picker" type="button" onclick="closeDatePicker();">OK</button>
            </form>
            <div class="location-filter" id="place-picker-button">
                <span class="location-icon"></span>
                <span class="filter-button-text">&nbsp;&nbsp;Ort</span>
            </div>
            <form id="place-picker">
                <p class="location-filter-headline">Nach Ort filtern</p>
                <button id="close-place-picker" type="button" onclick="closePlacePicker();">OK</button>
            </form>
            <div class="search-filter" id="search-filter-button">
                <span class="search-icon"></span>
                <span class="filter-button-text">&nbsp;&nbsp;Suche</span>
            </div>
            <div id="event-search-form">
                <p class="location-filter-headline">In Veranstaltungen suchen</p>
                {{insert_module::16}}
                <span id="close-search-form" onclick="closeSearchForm();">X</span>
            </div>
        </div>
    </div>
</div>