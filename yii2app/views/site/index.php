<?php

/* @var $this yii\web\View */

$this->title = 'Главная';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Онлайн-приемная</h1>

        <p class="lead"><a href="/site/register">Зарегистрируйтесь</a> и/или <a href="/site/login">авторизуйтесь</a> чтобы записаться на прием.</p>

        <p><a class="btn btn-lg btn-success" href="/admin/reception">Записаться</a></p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>1. Врач.</h2>

                <p>Выберите специализацию врача и/или фамилию из списка.</p>

            </div>
            <div class="col-lg-4">
                <h2>2. Дата и время.</h2>

                <p>Выберите подходящее время посещения.</p>

            </div>
            <div class="col-lg-4">
                <h2>3. Запись.</h2>

                <p>Внимание, записи могут меняться онлайн в процессе записи другими людьми.</p>

            </div>
        </div>

    </div>
</div>
