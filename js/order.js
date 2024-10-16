const wrapperOrderDish = document.querySelector(".wrapper-order-dish");
const btnAddDish = document.querySelector(".btnAddDish");
const resizeBox = document.querySelector(".resizeBox");

btnAddDish.onclick = function () {
  const newDishHTML = `
           <div class="row mb-4 align-items-center">
                  <div class="col-7">
                    <select
                      class="form-select"
                      aria-label="Default select example"
                    >
                      <option selected disabled>Vui lòng chọn món</option>
                      <option value="lau-bo">Lẩu bò</option>
                      <option value="lau-ech">Lẩu ếch</option>
                      <option value="ha-cao">Há cảo</option>
                    </select>
                  </div>
                  <div class="col-4">
                    <div class="">
                      <input
                        type="number"
                        class="form-control"
                        id="customerAdd"
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
};
