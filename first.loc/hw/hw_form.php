<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<body>
    <h3>Бланк заявки на кредит</h3>
    <div class="container">
        <!-- не стал делать имя, фамилию и отчество required для более простой проверки -->
        <form action="hw_form_handler.php" method="POST" class="col-md-3 col-lg-3 col-sm-3">
            <div class="mb-3">
                <label for="name" class="form-label">Имя</label>
                <input class="form-control" id="name" name="name"> 
            </div>
            <div class="mb-3">
                <label for="surname" class="form-label">Фамилия</label>
                <input class="form-control" id="surname" name="surname">
            </div>
            <div class="mb-3">
                <label for="patronym" class="form-label">Отчество</label>
                <input class="form-control" id="patronym" name="patronym">
            </div>
            <div class="mb-3">
                <label for="age" class="form-label">Возраст</label>
                <input required type="number" min="18" class="form-control" value="18" id="age" name="age">
            </div>


            <!-- radios -->
            <div>Пол</div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="gender" id="male" value="male" checked="true">
                <label class="form-check-label" for="male">
                    М
                </label>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="radio" name="gender" id="female" value="female">
                <label class="form-check-label" for="female">
                    Ж
                </label>
            </div>
            <br>

            <!-- select -->
            <div class="form-floating">
                <select class="form-select" id="work" name="work" aria-label="Floating label select example">
                    <option value="individual">ИП</option>
                    <option value="selfEmployed">Самозанятый</option>
                    <option value="LLC">ООО</option>
                </select>
                <label for="work">Занятость</label>
            </div>

            <!-- checkbox -->
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="parent" name="is_parent_hero" value="1">
                <label class="form-check-label" for="parent">Я многодетный родитель</label>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="retiree" name="is_retiree" value="1">
                <label class="form-check-label" for="retiree">Я пенсионер</label>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="svo" name="is_svo_part" value="1">
                <label class="form-check-label" for="svo">Я участник СВО</label>
            </div>

            <div class="mb-3">
                <label for="sum" class="form-label">Сумма</label>
                <input required type="number" min="1000" step="1000" class="form-control" value="1000" id="sum"
                    name="sum">
            </div>

            <div class="mb-3">
                <label for="term" class="form-label">Срок кредита (от 6 до 60 мес)</label>
                <input required type="number" min="6" max="60" class="form-control" value="6" id="term" name="term">
            </div>

            <div class="mb-3">
                <label for="inc" class="form-label">Доход</label>
                <input required type="number" min="1000" step="1000" class="form-control" value="1000" id="inc"
                    name="inc">
            </div>


            <button type="submit" class="btn btn-primary" name="sbmt" value="sbmt">Submit</button>
        </form>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
    </div>
</body>

</html>