/* Minimal client-side behavior using jQuery:
   - Add-to-cart buttons post the form via AJAX (progressive enhancement: it also works without JS).
   - Quantity inputs in the cart update totals via AJAX.
*/
$(function() {
  // AJAX add-to-cart
  $(document).on("submit", ".add-to-cart-form", function(e) {
    e.preventDefault();
    var $form = $(this);
    $.post("cart_action.php", $form.serialize() + "&action=add", function(resp) {
      if (resp && resp.ok) {
        $(".js-cart-count").text(resp.count);
        $(".js-toast").remove(); // remove old
        const toast = $('<div class="js-toast" style="position:fixed;right:16px;bottom:16px;background:#14335E;color:#fff;padding:10px 14px;border-radius:10px;box-shadow:0 8px 20px rgba(0,0,0,.2)">Zum Warenkorb hinzugefügt</div>');
        $("body").append(toast);
        setTimeout(()=>toast.fadeOut(300, ()=>toast.remove()), 1600);
      } else {
        alert("Fehler beim Hinzufügen.");
      }
    }, "json");
  });

  // Cart quantity update
  $(document).on("change keyup", ".js-qty", function() {
    var $row = $(this).closest("tr");
    var pid = $row.data("pid");
    var qty = parseInt($(this).val(), 10) || 1;
    if (qty < 1) qty = 1;
    $.post("cart_action.php", { action: "update", product_id: pid, quantity: qty }, function(resp) {
      if (resp && resp.ok) {
        $(".js-cart-count").text(resp.count);
        $row.find(".js-row-total").text(resp.row_total_formatted);
        $(".js-cart-total").text(resp.total_formatted);
      }
    }, "json");
  });

  // Remove from cart
  $(document).on("click", ".js-remove", function(e) {
    e.preventDefault();
    var $row = $(this).closest("tr");
    var pid = $row.data("pid");
    $.post("cart_action.php", { action: "remove", product_id: pid }, function(resp) {
      if (resp && resp.ok) {
        $row.remove();
        $(".js-cart-count").text(resp.count);
        $(".js-cart-total").text(resp.total_formatted);
        if (resp.count === 0) {
          $(".js-cart-table").replaceWith('<p>Dein Warenkorb ist leer.</p>');
        }
      }
    }, "json");
  });
});