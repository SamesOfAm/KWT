<script>
    (function showTrainerEvent(){
        let id = window.location.hash.replace ('#', '');
        let request = new XMLHttpRequest();
        request.open('GET', 'https://wshp.service.laekth.de/api/Events?FullText=Train%20the%20Trainer', true);
        request.setRequestHeader('X-API-KEY', '#m#c;Ck36BrL05SIgik%!AVcvjwpW~13+RK2Ssl|5k5G?@$_KV??-7?Z|K*aqs_J4')
        request.onload = function () {
          let data = JSON.parse(this.response).events;
            data.forEach(function(event) {
              console.log(event)
                if(event.veranstaltungnummer === parseInt(id)) {
                    let trueDate = event.von.replace("+", ".") + 'Z';
                  let d = new Date(trueDate);
                  let showDate;
                  showDate = ("0" + d.getDate()).slice(-2) +  '.&nbsp;' + ("0" + (d.getMonth() + 1)).slice(-2) + '.&nbsp;' + d.getFullYear()
                  if(event.bis) {
                    let trueEndDate = event.bis.replace("+", ".") + 'Z';
                    console.log('trueEndDate: ', trueEndDate)
                    let dEnd = new Date(trueEndDate);
                    showDate += ' bis ' + ("0" + dEnd.getDate()).slice(-2) +  '.&nbsp;' + ("0" + (dEnd.getMonth() + 1)).slice(-2) + '.&nbsp;' + dEnd.getFullYear()
                  }
                    let themen = '<span></span>';
                    if (event.themen != null) {
                        themen = '<p><strong>Themen</strong>:<br>' + event.themen.replaceAll('#','<br>') + '</p>';
                    }
                    document.getElementById('main').querySelector('.inside').querySelector('.mod_article').innerHTML = '<div class="mod_eventreader block">' +
                        '<div class="event layout_full block trainer" itemscope="" itemtype="http://schema.org/Event">' +
                        '<div class="event-detail-table-head">' +
                        '<span class="first-column">' +
                        'Train the Trainer</span>' +
                        '<span class="second-column">' + showDate + '</span>' +
                        '<span class="third-column">' + event.ortSuche + '</span>' +
                        '</div>' +
                        '<div class="event-detail-body">' +
                        '<div class="column first-column">' +
                        '<h1 itemprop="name">' + event.veranstaltung + '</h1>' +
                        '</div>' +
                        '<div class="column second-column">' +
                        '<span class="detail-body-head">Zeitraum</span>' +
                        '<p class="info"><time datetime="2019-09-18" itemprop="startDate">' + showDate + '<br><span>' + event.zeiten + '</span></time></p>' +
                        '</div>' +
                        '<div class="column third-column">' +
                        '<span class="detail-body-head">Veranstaltungsort</span>' +
                        '<p class="location">' + event.ortSuche + '</p>' +
                        '</div>' +
                        '<div class="ce_text block">' +
                        themen +
                        '<p><strong>KursleiterIn</strong>:<br>' + event.kursleiter + '</p>  ' +
                        '<p><strong>AnsprechpartnerIn</strong>:' +
                        '<br>' + event.ansprech + '<br>' + event.strasse + '<br>' + event.plz + ' ' + event.ort2 + '<br>' + event.telefon + '<br>' + '<a href="mailto:' + event.email + '">' + event.email + '</a>' +
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
