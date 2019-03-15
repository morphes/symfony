import React, { Component } from 'react';

import Button from 'components/Button';

export default class Product extends Component {
    render() {
        return (
            <div className="product">
                <p class="admin-edit">
                    <a class="admin-edit__link" href="http://mng.laparfumerie.ru/product/edit/2933">
                        администрировать
                    </a>
                </p>
                <div className="product__row">
                    <div class="product__brand">
                        <img
                            src="/catalog/2013/08/23/26289_237976.jpg.small.jpg"
                            data-handle="pseudolinks"
                            data-path="/duhi-agent-provocateur/"
                            class="product__brand-img"
                            alt="Agent Provocateur"
                        />
                        <span
                            class="product__brand-name"
                            data-handle="pseudolinks"
                            data-path="/duhi-agent-provocateur/"
                        >
                            Agent Provocateur
                        </span>
                        <h1 class="product__brand-title">Туалетные духи Agent Provocateur</h1>
                        <p class="product__brand-subtitle">Туалетные духи Агент Провокатор</p>
                        <div class="product__brand-stat">
                            <div class="product__brand-stat-star">
                                <i class="product-element__star--active" />
                                <i class="product-element__star--active" />
                                <i class="product-element__star--active" />
                                <i class="product-element__star--active" />
                            </div>
                            <span class="product__brand-stat-review">
                                <a href="#review">
                                    <i>1</i> отзыва
                                </a>
                            </span>
                            <div class="product__brand-stat-like">
                                <i class="product__brand-stat-like-img" />
                                <span class="product__brand-stat-like-num">
                                    <i>20</i> нравится
                                </span>
                            </div>
                        </div>
                        <div class="product__brand-info">
                            <input type="radio" name="odin" checked="checked" id="tab1" />
                            <label for="tab1" class="product__brand-info-li">
                                Доставка
                            </label>
                            <input type="radio" name="odin" id="tab2" />
                            <label for="tab2" class="product__brand-info-li">
                                Подарки к заказу
                                <span class="gifts-json__count" data-render="gifts_count">
                                    2
                                </span>
                            </label>
                            <input type="radio" name="odin" id="tab3" />
                            <label for="tab3" class="product__brand-info-li">
                                Оплата
                            </label>
                            <div class="product__brand-info-shipp product__brand-info-block" id="block1">
                                <p class="product__brand-info-shipp-p">
                                    Стоимость:
                                    <span data-render="minDelivery" data-price="1000">
                                        бесплатно по Москве от 1000 руб.; по&nbsp;России от 3000 руб.
                                    </span>
                                </p>
                                <p class="product__brand-info-shipp-p">
                                    Доставка по Москве:
                                    <span
                                        data-render="delivery_string"
                                        class="product__brand-info-shipp-p-date"
                                    >
                                        1-3 дня
                                    </span>
                                </p>
                                <ul class="product__brand-info-shipp-ul">
                                    <p class="product__brand-info-shipp-ul-p">Способ доставки:</p>
                                    <li class="product__brand-info-shipp-ul-post">
                                        <a href="http://laparfumerie.ru/info/dostavka-pochta-rossii.htm">
                                            Почта России
                                        </a>
                                        ,
                                    </li>
                                    <li class="product__brand-info-shipp-ul-post">
                                        <a href="http://laparfumerie.ru/info/delivery-and-payment.htm">
                                            Собственная курьерская служба
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div className="product__image">image</div>
                    <div data-behavior="addToCart" class="product__cart">
                        <div class="product__cart-block">
                            <div class="product__cart-block-name">
                                <h2 class="product__cart-block-name-h2">Туалетные духи 100 мл (тестер)</h2>
                                <p class="product__cart-block-name-art">
                                    Артикул <span class="product__cart-block-name-art-id">266816490</span>
                                </p>
                            </div>
                            <div class="product__cart-block-price active">
                                <strong class="product__cart-block-price-new">
                                    2610
                                    <span class="product__cart-block-price-currer">
                                        руб.
                                        <span />
                                    </span>
                                </strong>
                            </div>
                            <div class="product__cart-block-button">
                                <form
                                    id="cart_quantity"
                                    action="/basket/add"
                                    method="post"
                                    role="add-to-basket"
                                    class="product__cart-block-button-form product-item__frm"
                                >
                                    <input type="hidden" id="item_val" name="item_id" value="23599" />
                                    <input type="hidden" name="product_id" value="2933" />
                                    <div class="left-3" style={{ width: '60px' }}>
                                        <select
                                            name="amount"
                                            id="amount"
                                            data-price=""
                                            data-card="2922.00"
                                            class="select-group"
                                        >
                                            <option value="1">1</option> <option value="2">2</option>
                                            <option value="3">3</option> <option value="4">4</option>
                                            <option value="5">5</option> <option value="6">6</option>
                                            <option value="7">7</option> <option value="8">8</option>
                                            <option value="9">9</option> <option value="10">10</option>
                                        </select>
                                        <input type="hidden" data-name="name" value="" />
                                        <i class="click-arrow" />
                                    </div>
                                    <Button type="button" primary>
                                        Добавить в корзину
                                    </Button>
                                </form>
                            </div>
                            <div class="product__cart-block-type">
                                <ul data-behavior="utmCheck" class="product__cart-block-type-ul">
                                    <li
                                        data-handle="card_item"
                                        class="product__cart-block-type-ul-li product__cart-block-type-ul-li-active"
                                        data-price="2610"
                                        data-oldprice="2610"
                                        data-value="23599"
                                        data-title="Туалетные духи 100 мл (тестер)"
                                        data-id="266816490"
                                        data-delivery-date="1-3 дня"
                                    >
                                        <div class="product__cart-block-type-ul-li-container">
                                            <img
                                                src="/item/2015/01/18/23599_45305_353568.jpg.smaller.jpg"
                                                alt="Туалетные духи Agent Provocateur Туалетные духи 100 мл (тестер)"
                                                class="product__cart-block-type-ul-li-container-img"
                                            />
                                        </div>
                                        <div class="product__cart-block-type-ul-li-nameblock">
                                            Туалетные духи 100 мл (тестер)
                                            <div class="product__cart-block-type-ul-li-nameblock-price">
                                                2610
                                                <span class="product__cart-block-type-ul-li-nameblock-currer">
                                                    руб.
                                                </span>
                                            </div>
                                        </div>
                                    </li>
                                    <li
                                        data-handle="card_item"
                                        class="product__cart-block-type-ul-li--not_available"
                                    >
                                        <div class="product__cart-block-type-ul-li-container">
                                            <img
                                                src="/item/2015/01/18/3540_45303_353566.jpg.smaller.jpg"
                                                alt="Туалетные духи Agent Provocateur Туалетные духи 50 мл"
                                                class="product__cart-block-type-ul-li-container-img"
                                            />
                                        </div>
                                        <div class="product__cart-block-type-ul-li-nameblock">
                                            Туалетные духи 50 мл
                                            <div class="product__cart-block-type-ul-li-nameblock-available">
                                                Ожидает поступления
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}