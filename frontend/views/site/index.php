<?php

/* @var $this yii\web\View */

$this->title = Yii::$app->name;
?>
 <div id="layoutSidenav_content">
      <main>
        <div class="container-fluid">
          <h1 class="mt-4 mb-4 pagehead">Property Tax</h1>
          <a href="#" class="btnclassic"><img src="<?=Yii::$app->view->theme->baseUrl?>/images/ic_add.svg" alt="#"> Add New Property</a>
          <div class="row">
            <div class="col-md-12 col-sm-12">
              <div id="Propertytab">
                <ul>
                  <li class="ui-tabs-active"><a href="#property">Search Property</a></li>
                  <li><a href="#application1">Search Application</a></li>
                </ul>
                <div id="property">
                  <div class="row">
                    <div class="col-md-12">
                      <h2>Search Property</h2>
                      <p>Provide at least one non-mandatory parameter to search for an application</p>
                      <form>
                        <div class="form-row">
                          <div class="col-md-4">
                            <div class="form-group">
                              <label class="small mb-1" for="ulb">ULB*</label>
                              <select class="form-control" id="ulb" type="text">
                                <option>Select City</option>
                                <option>2</option>
                                <option>3</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label class="small mb-1" for="mobile">Owner Mobile No.*</label>
                              <input class="form-control input-20" id="mobile" type="text" value="+91">
                              <input class="form-control input-80" id="mobile" type="text" placeholder="Enter Your Mobile No.">
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label class="small mb-1" for="propertyid">Unique Property ID*</label>
                              <input class="form-control" id="propertyid" type="text" placeholder="Enter Unique Property ID">
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label class="small mb-1" for="propertyid">Existing Property ID*</label>
                              <input class="form-control" id="propertyid" type="text" placeholder="Enter Existing Property ID">
                            </div>
                          </div>
                        </div>
                        <div class="form-group mt-4 mb-0">
                          <button class="btn btn-primary">Search</button>
                          <button class="btn btn-secondary">Reset</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <div id="application1">
                  <p>&nbsp;</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
