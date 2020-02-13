<script>
    (function showTrainerEvent(){
        let id = window.location.hash.replace ('#', '');
        let request = new XMLHttpRequest();
        request.open('GET', 'https://www.laek-thueringen.de/webservice/veranstaltungen/', true);
        request.onload = function () {
            let data = JSON.parse(this.response);
            data.forEach(function(event) {
                if(event.VERANSTALTUNGNUMMER === id) {
                    let trueDate = event.VON_DATUM.replace("+", ".") + 'Z';
                    let d = new Date(trueDate);
                    let themen = '<span></span>';
                    if (event.THEMEN != null) {
                        themen = '<p><strong>Themen</strong>:<br>' + event.THEMEN + '</p>';
                    }
                    document.getElementById('main').querySelector('.inside').querySelector('.mod_article').innerHTML = '<div class="mod_eventreader block">' +
                        '<div class="event layout_full block trainer" itemscope="" itemtype="http://schema.org/Event">' +
                        '<div class="event-detail-table-head">' +
                        '<span class="first-column">' +
                        'Train the Trainer</span>' +
                        '<span class="second-column">' + ("0" + d.getDate()).slice(-2) +  '. ' + ("0" + (d.getMonth() + 1)).slice(-2) + '. ' + d.getFullYear() + '</span>' +
                        '<span class="third-column">' + event.INST_ORT + '</span>' +
                        '</div>' +
                        '<div class="event-detail-body">' +
                        '<div class="column first-column">' +
                        '<h1 itemprop="name">' + event.THEMA + '</h1>' +
                        '</div>' +
                        '<div class="column second-column">' +
                        '<span class="detail-body-head">Zeitraum</span>' +
                        '<p class="info"><time datetime="2019-09-18" itemprop="startDate">' + ("0" + d.getDate()).slice(-2) +  '. ' + ("0" + (d.getMonth() + 1)).slice(-2) + '. ' + d.getFullYear() + '</time><br><span>' + event.ZEITEN + '</span></p>' +
                        '</div>' +
                        '<div class="column third-column">' +
                        '<span class="detail-body-head">Veranstaltungsort</span>' +
                        '<p class="location">' + event.BEZEICHNUNG + '</p>' +
                        '</div>' +
                        '<div class="ce_text block">' +
                        themen +
                        '<p><strong>KursleiterIn</strong>:<br>' + event.KURSLEITER + '</p>  ' +
                        '<p><strong>AnsprechpartnerIn</strong>:' +
                        '<br>' + event.ANSPR_NAME + '<br>' + event.ANSPR_DIENSTSTELLE + '<br>' + event.ANSPR_PLZ + ' ' + event.ANSPR_ORT + '<br>' + event.ANSPR_TELEFON + '<br>' + '<a href="mailto:' + event.ANSPR_EMAIL + '">' + event.ANSPR_EMAIL + '</a>' +
                        '</p>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '<!-- indexer::stop -->' +
                        '<p class="back"><a href="javascript:history.go(-1)" title="Zurück">Zurück &lt;</a></p>' +
                        '<!-- indexer::continue -->' +
                        '</div>'
                }
            })
        };
        request.send();
    })();
</script>