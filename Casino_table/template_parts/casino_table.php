<style>
    :root {

        --casino-title-color: #9a9a9a;

        --casino-block-bg: #E6E6E6;
        --casino-bgcolor-cell: #ccc;
        --casino-colorBorder-cell: #000;

        --casino-btn-play-color: #fff;
        --casino-btn-play-bgc: #20c51a;
        --casino-btn-play-colorBorder: #168212;
        --casino-btn-play-bgc_hover: #1a9b16;
    }

    .casino_bl__title {
        font-weight: 600;
        text-transform: uppercase;
        color: var(--casino-title-color);
    }

    .tb_casino {
        position: relative;

        display: flex;
        flex-direction: row;
        justify-content: space-around;
        align-content: center;
        flex-wrap: wrap;

        width: 100%;
        margin: 10px auto;
        padding: 5px;
        background-color: var(--casino-block-bg);;
    }

    .tb_casino__block_logo {
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .tb_casino__logo {
        cursor: pointer;
    }

    .tb_casino__full {
        width: calc(50% + 120px);
        vertical-align: top;
    }

    .tb_casino__buttons {

        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .tb_casino__title {
        font-size: 25px;
        font-weight: 700;
        text-transform: uppercase;
        color: #444;
        margin-bottom: 10px;
    }

    .tb_casino__flag {
        display: inline-block;
        margin-right: 5px;
        margin-bottom: 5px;
    }

    .casino-table {
        width: 100%;
        border-collapse: collapse;
    }

    .casino-table th {
        text-align: left;
        background-color: var(--casino-bgcolor-cell);
        padding: 5px;
        border: 1px solid var(--casino-colorBorder-cell);

    }

    .casino-table td {
        padding: 5px;
        border: 1px solid var(--casino-colorBorder-cell);
    }

    .tb_casino__strong {
        font-weight: 700;
    }

    .btn_casino__play {
        margin: 10px 0;
        font-size: 18px;
        padding: 10px 3px;
        background-color: var(--casino-btn-play-bgc);
        color: var(--casino-btn-play-color);
        text-transform: uppercase;
        border: 3px solid var(--casino-btn-play-colorBorder);

        transition: .2s all;
    }

    .btn_casino__play:hover,
    .btn_casino__play:focus {
        transition: .2s all;
        background-color: var(--casino-btn-play-bgc_hover);
    }

    @media only screen and (max-width: 1600px) {

        .tb_casino {
            padding: 10px 5px;
        }

        .tb_casino__block_logo {
            display: block;
            width: 100%;
            text-align: center;
        }
    }

    @media only screen and (max-width: 1200px) {
        .tb_casino__title {
            font-size: 18px;
        }
    }

    @media only screen and (max-width: 768px) {

        .tb_casino {
            flex-direction: column;
        }

        .tb_casino__full {
            width: 100%;
        }

        .tb_casino__buttons {
            display: block;
            text-align: center;
        }

        .tb_casino__buttons > * {
            margin: 10px auto;
        }

    }

    @media only screen and (max-width: 480px) {
        .casino-table {
            font-size: 14px;
        }

        .casino-table td {
            padding: 0;
        }
    }


</style>

<?php

$currentTemplateUrl = get_template_directory_uri();

{
    ?>

    <h2 class="casino_bl__title">РЕЙТИНГ ОНЛАЙН КАЗИНО УКРАИНЫ</h2>

    <div class="tb_casino">
        <div class="tb_casino__block_logo">
            <img class="tb_casino__logo"
                 src='<?php echo $currentTemplateUrl; ?>/template_parts/casino_table_img/casinos/vulkan.jpg'
                 alt='вулкан голд' data-href=''>
        </div>
        <div class='tb_casino__full'>
            <p class="tb_casino__title">Онлайн казино <strong>вулкан голд</strong></p>
            <table class='casino-table'>
                <tbody>
                <tr>
                    <td> Казино принимает:</td>
                    <td>
                        <img class='tb_casino__flag' alt='ua'
                             src='<?php echo $currentTemplateUrl; ?>/template_parts/casino_table_img/flags/ua.png'>
                        <img class='tb_casino__flag' alt='ru'
                             src='<?php echo $currentTemplateUrl; ?>/template_parts/casino_table_img/flags/rus.png'>
                        <img class='tb_casino__flag' alt='ge'
                             src='<?php echo $currentTemplateUrl; ?>/template_parts/casino_table_img/flags/georgia.png'>
                        <img class='tb_casino__flag' alt='pol'
                             src='<?php echo $currentTemplateUrl; ?>/template_parts/casino_table_img/flags/poland.png'>
                        <img class='tb_casino__flag' alt='usa'
                             src='<?php echo $currentTemplateUrl; ?>/template_parts/casino_table_img/flags/usa.png'>
                        <img class='tb_casino__flag' alt='azb'
                             src='<?php echo $currentTemplateUrl; ?>/template_parts/casino_table_img/flags/azerbaijan.png'>
                    </td>
                </tr>
                <tr>
                    <td> Тип бонуса:</td>
                    <td class='tb_casino__strong'>Бонус за активность / Бонус на первый депозит</td>
                </tr>
                <tr>
                    <td> Производители:</td>
                    <td class='tb_casino__manufacturer'>
                        <img src='<?php echo $currentTemplateUrl; ?>/template_parts/casino_table_img/slot-icons/amatic.png' alt='amatic'>
                        <img src='<?php echo $currentTemplateUrl; ?>/template_parts/casino_table_img/slot-icons/aristocrat.png' alt='aristocrat'>
                        <img src='<?php echo $currentTemplateUrl; ?>/template_parts/casino_table_img/slot-icons/belatra.png' alt='belatra'>
                        <img src='<?php echo $currentTemplateUrl; ?>/template_parts/casino_table_img/slot-icons/betsoft.png' alt='betsoft'>
                        <img src='<?php echo $currentTemplateUrl; ?>/template_parts/casino_table_img/slot-icons/egt.png' alt='egt'>
                        <img src='<?php echo $currentTemplateUrl; ?>/template_parts/casino_table_img/slot-icons/elk.png' alt='elk'>
                        <img src='<?php echo $currentTemplateUrl; ?>/template_parts/casino_table_img/slot-icons/endorphina.png' alt='endorphina'>
                        <img src='<?php echo $currentTemplateUrl; ?>/template_parts/casino_table_img/slot-icons/igrosoft.png' alt='igrosoft'>
                        <img src='<?php echo $currentTemplateUrl; ?>/template_parts/casino_table_img/slot-icons/igt.png' alt='igt'>
                        <img src='<?php echo $currentTemplateUrl; ?>/template_parts/casino_table_img/slot-icons/megajack.png' alt='megajack'>
                        <img src='<?php echo $currentTemplateUrl; ?>/template_parts/casino_table_img/slot-icons/micra.png' alt='micra'>
                        <img src='<?php echo $currentTemplateUrl; ?>/template_parts/casino_table_img/slot-icons/mrslotty.png' alt='mrslotty'>
                        <img src='<?php echo $currentTemplateUrl; ?>/template_parts/casino_table_img/slot-icons/netent.png' alt='netent'>
                        <img src='<?php echo $currentTemplateUrl; ?>/template_parts/casino_table_img/slot-icons/nextgen.png' alt='nextgen'>
                        <img src='<?php echo $currentTemplateUrl; ?>/template_parts/casino_table_img/slot-icons/novomatic.png' alt='novomatic'>
                        <img src='<?php echo $currentTemplateUrl; ?>/template_parts/casino_table_img/slot-icons/nyx.png' alt='nyx'>
                        <img src='<?php echo $currentTemplateUrl; ?>/template_parts/casino_table_img/slot-icons/playtech.png' alt='playtech'>
                        <img src='<?php echo $currentTemplateUrl; ?>/template_parts/casino_table_img/slot-icons/push-gaming.png' alt='push-gaming'>
                        <img src='<?php echo $currentTemplateUrl; ?>/template_parts/casino_table_img/slot-icons/quickspin.png' alt='quickspin'>
                        <img src='<?php echo $currentTemplateUrl; ?>/template_parts/casino_table_img/slot-icons/thunderkick.png' alt='thunderkick'>
                        <img src='<?php echo $currentTemplateUrl; ?>/template_parts/casino_table_img/slot-icons/unicum.png' alt='unicum'>
                        <img src='<?php echo $currentTemplateUrl; ?>/template_parts/casino_table_img/slot-icons/ygg.png' alt='ygg'>
                    </td>
                </tr>
                <tr>
                    <td> Минимальный депозит:</td>
                    <td class='tb_casino__strong'>100 RUB</td>
                </tr>
                <tr>
                    <td> Рейтинг казино:</td>
                    <td> Рейтинг Кинг Лото <span class='tb_casino__strong'>33 из 100</span> / Рейтинг посетителей: <span
                                class='tb_casino__strong'>83.6 из 100</span></td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="tb_casino__buttons">
            <button class="btn_casino__play" type="button" data-href="https://www.ukr.net/">играть в казино</button>
        </div>
    </div>


    <div class="tb_casino">
        <div class="tb_casino__block_logo">
            <img class="tb_casino__logo"
                 src='<?php echo $currentTemplateUrl; ?>/template_parts/casino_table_img/casinos/vulkan-online.jpg'
                 alt='вулкан голд' data-href=''>
        </div>
        <div class='tb_casino__full'>
            <p class="tb_casino__title">Онлайн казино <strong>вулкан онлайн</strong></p>
            <table class='casino-table'>
                <tbody>
                <tr>
                    <td> Казино принимает:</td>
                    <td>
                        <img class='tb_casino__flag' alt='ua'
                             src='<?php echo $currentTemplateUrl; ?>/template_parts/casino_table_img/flags/ua.png'>
                        <img class='tb_casino__flag' alt='ru'
                             src='<?php echo $currentTemplateUrl; ?>/template_parts/casino_table_img/flags/rus.png'>
                    </td>
                </tr>
                <tr>
                    <td> Тип бонуса:</td>
                    <td class='tb_casino__strong'>Бонус за активность / Бонус на первый депозит</td>
                </tr>
                <tr>
                    <td> Производители:</td>
                    <td class='tb_casino__manufacturer'>
                        <img src='<?php echo $currentTemplateUrl; ?>/template_parts/casino_table_img/slot-icons/amatic.png' alt='amatic'>
                        <img src='<?php echo $currentTemplateUrl; ?>/template_parts/casino_table_img/slot-icons/aristocrat.png' alt='aristocrat'>
                        <img src='<?php echo $currentTemplateUrl; ?>/template_parts/casino_table_img/slot-icons/belatra.png' alt='belatra'>
                        <img src='<?php echo $currentTemplateUrl; ?>/template_parts/casino_table_img/slot-icons/betsoft.png' alt='betsoft'>
                        <img src='<?php echo $currentTemplateUrl; ?>/template_parts/casino_table_img/slot-icons/egt.png' alt='egt'>
                        <img src='<?php echo $currentTemplateUrl; ?>/template_parts/casino_table_img/slot-icons/elk.png' alt='elk'>
                        <img src='<?php echo $currentTemplateUrl; ?>/template_parts/casino_table_img/slot-icons/endorphina.png' alt='endorphina'>
                        <img src='<?php echo $currentTemplateUrl; ?>/template_parts/casino_table_img/slot-icons/igrosoft.png' alt='igrosoft'>
                        <img src='<?php echo $currentTemplateUrl; ?>/template_parts/casino_table_img/slot-icons/igt.png' alt='igt'>
                    </td>
                </tr>
                <tr>
                    <td> Минимальный депозит:</td>
                    <td class='tb_casino__strong'>100 RUB</td>
                </tr>
                <tr>
                    <td> Рейтинг казино:</td>
                    <td> Рейтинг Кинг Лото <span class='tb_casino__strong'>33 из 100</span> / Рейтинг посетителей: <span
                                class='tb_casino__strong'>98 из 100</span></td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="tb_casino__buttons">
            <button class="btn_casino__play" type="button" data-href="https://www.ukr.net/">играть в казино</button>
        </div>
    </div>


    <?php
}


