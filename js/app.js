$("#botModal").on("click",function(){
    $("#modal-fecha").modal();
});

$('.vc-date').datepicker({
    format: "yyyy/mm/dd",
    language: "es",
    multidateSeparator: "-",
});