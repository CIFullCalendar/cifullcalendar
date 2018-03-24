/*!
 * CIFullcalendar v3
 * Docs & License: http://www.cifullcalendar.com
 * (c) 2018 Sir.Dre
 */ 
!function( e ) {
   "function" == typeof define && define.amd ? define( [ "jquery", "moment" ]
      , e ) : "object" == typeof exports ? module.exports = e( require(
      "jquery" ), require( "moment" ) ) : e( jQuery, moment )
}( function( e, a ) {
   Object.defineProperty( a, "__esModule", {
      value: !0
   } );
   e.fn.cifullCalendar.locales.en = {
      addMsg: function() {
         return "Event Added Successfully"
      }
      , updateMsg: function() {
         return "Event Updated Successfully"
      }
      , delMsg: function() {
         return "Event Deleted Successfully"
      }
      , uploadMsg: function() {
         return "Event Uploaded Successfully"
      }
      , dragMsg: function() {
         return "Event Dropped Successfully"
      }
      , publicMsg: function() {
         return "Event is Queued for Review"
      }
      , recurMsg: function() {
         return "Please enter a recurring end date"
      }
      , Err: function() {
         return "Unable to Save Event"
      }
      , linktog: "Export to Google"
      , linktoy: "Export to Yahoo"
      , linktol: "Export to Live"
      , linktoi: "Export to ICS"
   }, e.extend( $.fn.cifullCalendar.defaults, e.fn.cifullCalendar.locales
      .en ), e.fullCalendar.locale( "ar" ), e.datepicker && e.datepicker.setDefaults(
      e.datepicker.regional[ "" ] ), e.fn.cifullCalendar.locales.ar = {
      addMsg: function() {
         return "الحدث أضيف بنجاح"
      }
      , updateMsg: function() {
         return "الحدث التحديث بنجاح"
      }
      , delMsg: function() {
         return "الحدث المحذوفة بنجاح"
      }
      , uploadMsg: function() {
         return "حدث تم تحميلها بنجاح"
      }
      , dragMsg: function() {
         return "مسقطة الحدث بنجاح"
      }
      , publicMsg: function() {
         return "في قائمة الانتظار حدث للمراجعة"
      }
      , recurMsg: function() {
         return "يرجى إدخال تاريخ انتهاء متكرر"
      }
      , Err: function() {
         return "غير قادر على حفظ الحدث"
      }
      , linktog: "تصدير إلى Google"
      , linktoy: "تصدير إلى Yahoo"
      , linktol: "تصدير إلى Live"
      , linktoi: "تصدير إلى ICS"
   }, e.extend( $.fn.cifullCalendar.defaults, e.fn.cifullCalendar.locales
      .ar ), e.fn.cifullCalendar.locales.es = {
      addMsg: function() {
         return "Evento agregado con éxito"
      }
      , updateMsg: function() {
         return "Evento actualizado correctamente"
      }
      , delMsg: function() {
         return "Evento eliminado correctamente"
      }
      , uploadMsg: function() {
         return "Evento Subido con éxito"
      }
      , dragMsg: function() {
         return "Evento Abandonado con éxito"
      }
      , publicMsg: function() {
         return "Evento se pone en cola para revisión"
      }
      , recurMsg: function() {
         return "Por favor, introduzca una fecha de finalización recurrente"
      }
      , Err: function() {
         return "No se puede guardar Evento"
      }
      , linktog: "Exportar a Google"
      , linktoy: "Exportar a Yahoo"
      , linktol: "Exportar a Live"
      , linktoi: "Exportar a ICS"
   }, e.extend( $.fn.cifullCalendar.defaults, e.fn.cifullCalendar.locales
      .es ), e.fullCalendar.locale( "de" ), e.datepicker && e.datepicker.setDefaults(
      e.datepicker.regional[ "" ] ), e.fn.cifullCalendar.locales.de = {
      addMsg: function() {
         return "Ereignis erfolgreich hinzugefügt"
      }
      , updateMsg: function() {
         return "Ereignis erfolgreich aktualisiert"
      }
      , delMsg: function() {
         return "Ereignis wurde erfolgreich gelöscht"
      }
      , uploadMsg: function() {
         return "Ereignis wurde erfolgreich hochgeladen"
      }
      , dragMsg: function() {
         return "Ereignis wurde erfolgreich gelöscht"
      }
      , publicMsg: function() {
         return "Das Ereignis wird zur Überprüfung eingereiht"
      }
      , recurMsg: function() {
         return "Bitte geben Sie ein wiederkehrendes Enddatum ein"
      }
      , Err: function() {
         return "Event kann nicht gespeichert werden"
      }
      , linktog: "In Google exportieren"
      , linktoy: "Nach Yahoo exportieren"
      , linktol: "In Live exportieren"
      , linktoi: "Nach ICS exportieren"
   }, e.extend( $.fn.cifullCalendar.defaults, e.fn.cifullCalendar.locales
      .de ), e.fn.cifullCalendar.locales.fr = {
      addMsg: function() {
         return "Événement ajouté avec succès"
      }
      , updateMsg: function() {
         return "Événement correctement mis à jour"
      }
      , delMsg: function() {
         return "Événement supprimé avec succès"
      }
      , uploadMsg: function() {
         return "Événement soumis avec succès"
      }
      , dragMsg: function() {
         return "Événement réussi Abandonné"
      }
      , publicMsg: function() {
         return "Événement est en attente d examen"
      }
      , recurMsg: function() {
         return "S'il vous plaît entrer une date de fin récurrente"
      }
      , Err: function() {
         return "Impossible d enregistrer l événement"
      }
      , linktog: "Exporter vers Google"
      , linktoy: "Exporter vers Yahoo"
      , linktol: "Exporter vers Live"
      , linktoi: "Exporter vers ICS"
   }, e.extend( $.fn.cifullCalendar.defaults, e.fn.cifullCalendar.locales
      .fr ), e.fn.cifullCalendar.locales.id = {
      addMsg: function() {
         return "Acara berhasil Ditambahkan"
      }
      , updateMsg: function() {
         return "Acara berhasil diperbarui"
      }
      , delMsg: function() {
         return "Acara berhasil dihapus"
      }
      , uploadMsg: function() {
         return "Acara berhasil dimuat"
      }
      , dragMsg: function() {
         return "Menjatuhkan acara berhasil"
      }
      , publicMsg: function() {
         return "Acara yang antri untuk ulasan"
      }
      , recurMsg: function() {
         return "Sertakan tanggal akhir untuk berulang"
      }
      , Err: function() {
         return "Tidak dapat menyimpan acara"
      }
      , linktog: "Ekspor ke Google"
      , linktoy: "Ekspor ke Yahoo"
      , linktol: "Ekspor ke Hidup"
      , linktoi: "Ekspor ke ICS"
   }, e.extend( $.fn.cifullCalendar.defaults, e.fn.cifullCalendar.locales
      .id ), e.fn.cifullCalendar.locales.it = {
      addMsg: function() {
         return "Evento Aggiunto con successo"
      }
      , updateMsg: function() {
         return "Evento aggiornato con successo"
      }
      , delMsg: function() {
         return "Evento cancellato con successo"
      }
      , uploadMsg: function() {
         return "Evento caricato con successo"
      }
      , dragMsg: function() {
         return "Evento Dropped con successo"
      }
      , publicMsg: function() {
         return "Evento è in coda per la revisione"
      }
      , recurMsg: function() {
         return "Si prega di inserire una data di fine ricorrente"
      }
      , Err: function() {
         return "Impossibile salvare l'evento"
      }
      , linktog: "Esporta in Google"
      , linktoy: "Export a Yahoo"
      , linktol: "Export to Live"
      , linktoi: "Esporta in ICS"
   }, e.extend( $.fn.cifullCalendar.defaults, e.fn.cifullCalendar.locales
      .it ), e.fn.cifullCalendar.locales.pt = {
      addMsg: function() {
         return "Evento adicionado com sucesso"
      }
      , updateMsg: function() {
         return "Evento atualizado com sucesso"
      }
      , delMsg: function() {
         return "Evento excluído com sucesso"
      }
      , uploadMsg: function() {
         return "Evento Submetido com sucesso"
      }
      , dragMsg: function() {
         return "Evento de sucesso abandonado"
      }
      , publicMsg: function() {
         return "Evento está na fila para revisão"
      }
      , recurMsg: function() {
         return "Por favor, indique uma data final recorrente"
      }
      , Err: function() {
         return "Não foi possível salvar evento"
      }
      , linktog: "Exportar para o Google"
      , linktoy: "Exportar para o Yahoo"
      , linktol: "Exportar para o Live"
      , linktoi: "Exportar para o ICS"
   }, e.extend( $.fn.cifullCalendar.defaults, e.fn.cifullCalendar.locales
      .pt ), e.fn.cifullCalendar.locales.nl = {
      addMsg: function() {
         return "Event succesvol toegevoegd"
      }
      , updateMsg: function() {
         return "Event succesvol bijgewerkt"
      }
      , delMsg: function() {
         return "Event succesvol verwijderd"
      }
      , uploadMsg: function() {
         return "Event geüpload"
      }
      , dragMsg: function() {
         return "Event Dropped succesvol"
      }
      , publicMsg: function() {
         return "Gebeurtenis wordt in de wachtrij voor Beoordeling"
      }
      , recurMsg: function() {
         return "Geef een terugkerend einddatum"
      }
      , Err: function() {
         return "Niet in staat om Event opslaan"
      }
      , linktog: "Exporteren naar Google"
      , linktoy: "Exporteren naar Yahoo"
      , linktol: "Exporteren naar Live"
      , linktoi: "Exporteren naar ICS"
   }, e.extend( $.fn.cifullCalendar.defaults, e.fn.cifullCalendar.locales
      .nl ), e.fn.cifullCalendar.locales.ru = {
      addMsg: function() {
         return "Событие успешно добавлен"
      }
      , updateMsg: function() {
         return "Событие успешно обновлены"
      }
      , delMsg: function() {
         return "Событие успешно удален"
      }
      , uploadMsg: function() {
         return "Событие успешно загружен"
      }
      , dragMsg: function() {
         return "Событие Выпало успешно"
      }
      , publicMsg: function() {
         return "Событие В очереди на обзор"
      }
      , recurMsg: function() {
         return "Пожалуйста, введите повторяющуюся дату окончания"
      }
      , Err: function() {
         return "Невозможно, чтобы сохранить событие"
      }
      , linktog: "Экспорт в Google"
      , linktoy: "Экспорт в Yahoo"
      , linktol: "Экспорт в Live"
      , linktoi: "Экспорт в ICS"
   }, e.extend( $.fn.cifullCalendar.defaults, e.fn.cifullCalendar.locales
      .ru ), e.fn.cifullCalendar.locales.ko = {
      addMsg: function() {
         return "이벤트가 성공적으로 추가"
      }
      , updateMsg: function() {
         return "이벤트가 성공적으로 업데이트"
      }
      , delMsg: function() {
         return "이벤트가 성공적으로 삭제"
      }
      , uploadMsg: function() {
         return "이벤트는 성공적으로 업로드"
      }
      , dragMsg: function() {
         return "이벤트는 성공적으로 떨어졌다"
      }
      , publicMsg: function() {
         return "이벤트는 검토를 위해 대기"
      }
      , recurMsg: function() {
         return "반복 종료 날짜를 입력 해주세요"
      }
      , Err: function() {
         return "이벤트를 저장 할 수 없습니다"
      }
      , linktog: "Google로 내보내기"
      , linktoy: "야후로 내보내기"
      , linktol: "수출 라이브합니다"
      , linktoi: "ICS로 내보내기"
   }, e.extend( $.fn.cifullCalendar.defaults, e.fn.cifullCalendar.locales
      .ko ), e.fn.cifullCalendar.locales[ "zh-cn" ] = {
      addMsg: function() {
         return "事件添加成功"
      }
      , updateMsg: function() {
         return "活动已成功更新"
      }
      , delMsg: function() {
         return "活动已成功删除"
      }
      , uploadMsg: function() {
         return "事件上传成功"
      }
      , dragMsg: function() {
         return "事件丢弃成功"
      }
      , publicMsg: function() {
         return "事件排队等待审查"
      }
      , recurMsg: function() {
         return "请输入一个反复出现的结束日期"
      }
      , Err: function() {
         return "无法保存活动"
      }
      , linktog: "导出到谷歌"
      , linktoy: "导出到雅虎"
      , linktol: "出口到Live"
      , linktoi: "导出到ICS"
   }, e.extend( $.fn.cifullCalendar.defaults, e.fn.cifullCalendar.locales[
      "zh-cn" ] )
} );