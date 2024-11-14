const wrapperOrderDish = document.querySelector(".wrapper-order-dish");
const btnAddDish = document.querySelector(".btnAddDish");
const resizeBox = document.querySelector(".resizeBox");
let dishCount = 1;

btnAddDish.onclick = function () {
  const newDishHTML = `
    <div class="row mb-4 align-items-center dish dish${dishCount}">
      <div class="col-7">
        <div class="">
         <select class="form-control form-select" id="customerAddDish" name="dish[]">
           ${dishOptions}
        </select>
        </div>
      </div>
      <div class="col-4">
        <div class="">
          <input
          name="quantity[]"
            type="number"
            class="form-control"
            id="customerAddQuantity"
            placeholder="Nhập số lượng"
          />
        </div>
      </div>
      <div class="col-1 d-flex justify-content-center">
        <i style="display: block" class="ti-trash"></i>
      </div>
    </div>
  `;

  wrapperOrderDish.insertAdjacentHTML("beforeend", newDishHTML);
  resizeBox.classList.replace("col-5", "col-4");

  const trashIcon = wrapperOrderDish.querySelector(
    `.dish${dishCount} .ti-trash`
  );
  trashIcon.onclick = function () {
    const dishElement = this.closest(".dish");
    if (dishElement) {
      dishElement.remove();

      // Kiểm tra xem còn phần tử .dish nào không
      if (wrapperOrderDish.querySelectorAll(".dish").length === 0) {
        resizeBox.classList.replace("col-4", "col-5");
      }
    }
  };

  dishCount++;
};
