<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="breadcrumb__text">
                    <h4>Storico</h4>
                    <div class="breadcrumb__links">
                        <a href="/cliente/index">Home</a>
                        <span>Storico</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="breadcrumb__text">
                    <h4>Saldo</h4>
                    <a><?php echo number_format($utente->esposizione,2,',',' ') . ' €' ?></a>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="breadcrumb__text">
                    <h4>Fido</h4>
                    <a><?php echo number_format($utente->fido,2,',',' ') . ' €' ?></a>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Checkout Section Begin -->
<section class="checkout spad" style="margin-top: -4%">
    <div class="container">
        <!--<div class="checkout__form">
            <form action="#">
                <div class="row">
                    <div class="col-lg-8 col-md-6">
                        <h6 class="coupon__code"><span class="icon_tag_alt"></span> Have a coupon? <a href="#">Click
                                here</a> to enter your code</h6>
                        <h6 class="checkout__title">Billing Details</h6>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Fist Name<span>*</span></p>
                                    <input type="text">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Last Name<span>*</span></p>
                                    <input type="text">
                                </div>
                            </div>
                        </div>
                        <div class="checkout__input">
                            <p>Country<span>*</span></p>
                            <input type="text">
                        </div>
                        <div class="checkout__input">
                            <p>Address<span>*</span></p>
                            <input type="text" placeholder="Street Address" class="checkout__input__add">
                            <input type="text" placeholder="Apartment, suite, unite ect (optinal)">
                        </div>
                        <div class="checkout__input">
                            <p>Town/City<span>*</span></p>
                            <input type="text">
                        </div>
                        <div class="checkout__input">
                            <p>Country/State<span>*</span></p>
                            <input type="text">
                        </div>
                        <div class="checkout__input">
                            <p>Postcode / ZIP<span>*</span></p>
                            <input type="text">
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Phone<span>*</span></p>
                                    <input type="text">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Email<span>*</span></p>
                                    <input type="text">
                                </div>
                            </div>
                        </div>
                        <div class="checkout__input__checkbox">
                            <label for="acc">
                                Create an account?
                                <input type="checkbox" id="acc">
                                <span class="checkmark"></span>
                            </label>
                            <p>Create an account by entering the information below. If you are a returning customer
                                please login at the top of the page</p>
                        </div>
                        <div class="checkout__input">
                            <p>Account Password<span>*</span></p>
                            <input type="text">
                        </div>
                        <div class="checkout__input__checkbox">
                            <label for="diff-acc">
                                Note about your order, e.g, special noe for delivery
                                <input type="checkbox" id="diff-acc">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="checkout__input">
                            <p>Order notes<span>*</span></p>
                            <input type="text"
                                   placeholder="Notes about your order, e.g. special notes for delivery.">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="checkout__order">
                            <h4 class="order__title">Your order</h4>
                            <div class="checkout__order__products">Product <span>Total</span></div>
                            <ul class="checkout__total__products">
                                <li>01. Vanilla salted caramel <span>$ 300.0</span></li>
                                <li>02. German chocolate <span>$ 170.0</span></li>
                                <li>03. Sweet autumn <span>$ 170.0</span></li>
                                <li>04. Cluten free mini dozen <span>$ 110.0</span></li>
                            </ul>
                            <ul class="checkout__total__all">
                                <li>Subtotal <span>$750.99</span></li>
                                <li>Total <span>$750.99</span></li>
                            </ul>
                            <div class="checkout__input__checkbox">
                                <label for="acc-or">
                                    Create an account?
                                    <input type="checkbox" id="acc-or">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adip elit, sed do eiusmod tempor incididunt
                                ut labore et dolore magna aliqua.</p>
                            <div class="checkout__input__checkbox">
                                <label for="payment">
                                    Check Payment
                                    <input type="checkbox" id="payment">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="checkout__input__checkbox">
                                <label for="paypal">
                                    Paypal
                                    <input type="checkbox" id="paypal">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <button type="submit" class="site-btn">PLACE ORDER</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>-->
        <div class="container">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="tab1-tab" data-toggle="tab" href="#tab1" role="tab" aria-controls="tab1" aria-selected="true">Ordini</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="tab2-tab" data-toggle="tab" href="#tab2" role="tab" aria-controls="tab2" aria-selected="false">Fatture</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1-tab">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="main-box clearfix">
                                <div class="table-responsive">
                                    <table class="table user-list">
                                        <thead>
                                        <tr style="background-color: #84B0CA">
                                            <th style="text-align: center;color: white"><label>N° Documento</label></th>
                                            <th style="text-align: center;color: white"><label>Tipo Documento</label></th>
                                            <th style="text-align: center;color: white"><label>Creata il </label></th>
                                            <th style="text-align: center;color: white"><label>Stato</label></th>
                                            <th style="text-align: center;color: white"><label>Email</label></th>
                                            <th>&nbsp;</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($ordini  as $f){ ?>
                                        <tr>
                                            <td>
                                                <a class="user-link"
                                                   style="margin-left: 40%!important"><?php echo $f->numerodoc ?></a>
                                            </td>
                                            <td>
                                                <a class="user-link"
                                                   style="margin-left: 40%!important"><?php echo $f->cd_do ?></a>
                                            </td>
                                            <td style="text-align: center">
                                                    <?php echo date_format(date_create($f->datadoc), 'd-m-Y'); ?>
                                            </td>
                                            <td style="text-align: center">
                                    <span class="label label-danger"><?php echo ($f->righeevadibili == 0) ? 'Evaso' : 'Da Evadere'; ?></span>
                                            </td>
                                            <td>
                                                <a><?php echo $utente->email; ?></a>
                                            </td>
                                            <td style="width: 20%;text-align: center">
                                                <a href="/cliente/dettaglio_storico/<?php echo $f->id_dotes?>" class="table-link">
                                     <span class="fa-stack">
                                         <i class="fa fa-square fa-stack-2x"></i>
                                         <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>
                                     </span>
                                                </a>
                                                <!--<a href="#" class="table-link">
                                                 <span class="fa-stack">
                                                     <i class="fa fa-square fa-stack-2x"></i>
                                                     <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                                                 </span>
                                                </a>
                                                <a href="#" class="table-link danger">
                                                 <span class="fa-stack">
                                                     <i class="fa fa-square fa-stack-2x"></i>
                                                     <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>
                                                 </span>
                                                </a>-->
                                            </td>
                                        </tr>
                                        <?php } ?>

                                        </tbody>
                                    </table>
                                </div>
                                <ul class="pagination pull-right">
                                    <!--     <li><a href="#"><i class="fa fa-chevron-left"></i></a></li>
                                         <li><a href="#">1</a></li>
                                         <li><a href="#">2</a></li>
                                         <li><a href="#">3</a></li>
                                         <li><a href="#">4</a></li>
                                         <li><a href="#">5</a></li>
                                         <li><a href="#"><i class="fa fa-chevron-right"></i></a></li>-->
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="main-box clearfix">
                                <div class="table-responsive">
                                    <table class="table user-list">
                                        <thead>
                                        <tr style="background-color: #84B0CA">
                                            <th style="text-align: center;color: white"><label>N° Documento</label></th>
                                            <th style="text-align: center;color: white"><label>Tipo Documento</label></th>
                                            <th style="text-align: center;color: white"><label>Creata il </label></th>
                                            <th style="text-align: center;color: white"><label>Stato</label></th>
                                            <th style="text-align: center;color: white"><label>Email</label></th>
                                            <th>&nbsp;</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($fatture  as $f){ ?>
                                        <tr>
                                            <td>
                                                <a class="user-link"
                                                   style="margin-left: 40%!important"><?php echo $f->numerodoc ?></a>
                                            </td>
                                            <td>
                                                <a class="user-link"
                                                   style="margin-left: 40%!important"><?php echo $f->cd_do ?></a>
                                            </td>
                                            <td style="text-align: center">
                                                    <?php echo date_format(date_create($f->datadoc), 'd-m-Y'); ?>
                                            </td>
                                            <td style="text-align: center">
                                    <span class="label label-danger"><?php if ($f->cd_do == 'FTV') { ?><?php
                                            if ($f->pagata == '0') echo 'Non Pagata';
                                            if ($f->pagata == '1') echo 'Pagata';
                                            if ($f->pagata == '2') echo 'Pagata Parzialmente';
                                            ?><?php } else { ?><?php echo ($f->righeevadibili == 0) ? 'Evaso' : 'Da Evadere';
                                        } ?></span>
                                            </td>
                                            <td>
                                                <a><?php echo $utente->email; ?></a>
                                            </td>
                                            <td style="width: 20%;text-align: center">
                                                <a href="/cliente/dettaglio_storico/<?php echo $f->id_dotes?>" class="table-link">
                                     <span class="fa-stack">
                                         <i class="fa fa-square fa-stack-2x"></i>
                                         <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>
                                     </span>
                                                </a>
                                                <!--<a href="#" class="table-link">
                                                 <span class="fa-stack">
                                                     <i class="fa fa-square fa-stack-2x"></i>
                                                     <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                                                 </span>
                                                </a>
                                                <a href="#" class="table-link danger">
                                                 <span class="fa-stack">
                                                     <i class="fa fa-square fa-stack-2x"></i>
                                                     <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>
                                                 </span>
                                                </a>-->
                                            </td>
                                        </tr>
                                        <?php } ?>

                                        </tbody>
                                    </table>
                                </div>
                                <ul class="pagination pull-right">
                                    <!--     <li><a href="#"><i class="fa fa-chevron-left"></i></a></li>
                                         <li><a href="#">1</a></li>
                                         <li><a href="#">2</a></li>
                                         <li><a href="#">3</a></li>
                                         <li><a href="#">4</a></li>
                                         <li><a href="#">5</a></li>
                                         <li><a href="#"><i class="fa fa-chevron-right"></i></a></li>-->
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Checkout Section End -->
