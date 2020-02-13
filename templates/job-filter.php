<div class="ce_text job-filter-wrapper block">
    <div class="event-filter">
        <div class="filter-headline">
            <span>Filter</span>
        </div>
        <div class="filter-radio">
            <form id="event-radio-form">
                <div class="radio-option">
                    <label for="single">
                        <input type="checkbox" id="single">
                        <span></span>
                        &nbsp;&nbsp;Einzelpraxis
                    </label>
                </div>
                <div class="radio-option">
                    <label for="group">
                        <input type="checkbox" id="group">
                        <span></span>
                        &nbsp;&nbsp;Gemeinschaftspraxis
                    </label>
                </div>
                <div class="radio-option">
                    <label for="multiple">
                        <input type="checkbox" id="multiple">
                        <span></span>
                        &nbsp;&nbsp;Praxisgemeinschaft
                    </label>
                </div>
                <div class="radio-option">
                    <label for="mvz">
                        <input type="checkbox" id="mvz">
                        <span></span>
                        &nbsp;&nbsp;MVZ
                    </label>
                </div>
                <div class="radio-option">
                    <label for="hospital">
                        <input type="checkbox" id="hospital">
                        <span></span>
                        &nbsp;&nbsp;Krankenhaus
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
                <p class="location-filter-headline">Nach Einstellungsdatum filtern</p>
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
                <p class="location-filter-headline">In Stellenausschreibungen suchen</p>
                {{insert_module::33}}
                <span id="close-search-form" onclick="closeSearchForm();">X</span>
            </div>
        </div>
    </div>
    <div class="post-job-button">
        <a href="{{link_url::20}}">Inserieren</a>
    </div>
</div>