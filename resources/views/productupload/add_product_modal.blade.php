  <!-- Modal -->
  <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
      <form action="..." method="post" id="addProductForm">
          @csrf

          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="addModalLabel">Add Product</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                      <div class="errMsgContainer mb-3"></div>

                      <div class="form-group">
                          <label for="name">Product Name</label>
                          <input type="text" class="form-control" name="name" id="name"
                              placeholder="Enter name">

                      </div>

                      <div class="form-group mt-2">
                          <label for="name">Product price </label>
                          <input type="text" class="form-control" name="price" id="price"
                              placeholder="Enter Price ">
                      </div>

                      <div class="form-group mt-2">
                          <label for="name">Product Category</label>
                          <input type="text" class="form-control" name="category" id="category"
                              placeholder="Enter Category ">
                      </div>

                      <div class="form-group mt-2">
                          <label for="name">Product Description </label>
                          <textarea name="description"class="form-control" id="description" cols="30" rows="4"></textarea>
                      </div>


                      <div class="form-group mt-2">
                          <label for="name">Product Gallary </label>
                          <input type="url" id="gallery" name="gallery" class="form-control">
                      </div>

                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary add_product">Save Product</button>
                  </div>
              </div>
          </div>

      </form>
  </div>
