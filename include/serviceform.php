            <div class="row">
                  <div class="col-md-6">
                      <div class="form-group">
                          <label>Type of service</label>
                          <input name="service" type="text" class="form-control" value="<?php  if (!$insert) { echo $service; } ?>" />
                      </div>
                  </div>
                  <div class="col-md-6">
                      <div class="form-group">
                            <label>Description</label>
                            <input name="description" type="text"  class="form-control" value="<?php if (!$insert) { echo $description; } ?>" />
                      </div>
                      
                  </div>
            </div>
            <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Diagnostic price</label>
                            <input name="diagnostic_price" type="text" class="form-control" value="<?php  if (!$insert) { echo $diagnostic_price; } ?>" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                          <label>Price</label>
                          <input name="price" type="text"  class="form-control" value="<?php  if (!$insert) { echo $price; } ?>" />
                      </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Priority of service</label>
                            <select name="rush" class="form-control">
                                <option value="<?php  if (!$insert) { echo $rush; } ?>" selected="selected"><?php  if (!$insert) { echo $labelpriority; } ?></option>
                                <option value="0">Normal priority</option>
                                <option value="1">High priority</option>
                            </select>
                        </div>
                    </div>

                    <?php 

                        if (!$insert) {
                    ?>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Service active?</label>
                            <select name="isActive" class="form-control">
                                <option value="<?php echo $isActive ?>" selected="selected"><?php echo $labelactive ?></option>
                                <option value="1">Service is active</option>
                                <option value="0">Service is NOT active</option>
                            </select>
                        </div>
                    </div>
                    <?php

                        }
                    ?>
            </div>