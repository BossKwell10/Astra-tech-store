
$(function() {

    $("#btnShowModal").on("click", function () {
        $('#paymentModal').modal('show');
    });
    

    $("#amountRecu").on("input", function () {
    const amount = +$('#amount').val(); 
    const amountRecu = +$(this).val();  
    const amountReste = amountRecu - amount;

    if(amountReste < 0){
        $('.invalid-feedback').css('display', 'block');
    }else{
        $('.invalid-feedback').css('display', 'none');
    }
    
    $('#amountReste').val(amountReste); 
});

});