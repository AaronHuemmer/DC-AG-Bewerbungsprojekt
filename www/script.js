$(function(){
    $(".add-to-cart").click(function(){
        var id = $(this).data("id");
        $.post("update_cart.php", {id: id}, function(){
            alert("Produkt zum Warenkorb hinzugefügt!");
        });
    });
});