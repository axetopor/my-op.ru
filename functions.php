<?php

/**
 * Функция для получения альбомов пользователя или группы из VK API.
 *
 * @param int $owner_id ID владельца альбома (пользователь или группа).
 * @param string $token Токен доступа для VK API.
 * @param mixed $iferr Параметр для обработки ошибок (не используется в текущей реализации).
 */
function AlbumsGet($owner_id, $token, $iferr) {
    // Проверяем, переданы ли параметры капчи в GET-запросе
    $captcha = isset($_GET['captcha_sid']) && isset($_GET['captcha_key']) 
        ? '&captcha_sid=' . $_GET['captcha_sid'] . '&captcha_key=' . $_GET['captcha_key'] 
        : '';

    // Используем глобальные переменные для хранения результатов
    global $param, $albums_count, $album_title, $group_title, $error;

    // Формируем параметр owner_id для запроса
    $id = 'owner_id=' . $owner_id . '&';

    // Формируем URL для запроса к VK API
    $url = 'https://api.vk.com/method/photos.getAlbums?' . $id . '&need_covers=1&need_system=1&access_token=' . $token . $captcha;
    
    // Выполняем запрос к API и декодируем JSON-ответ
    $json = file_get_contents($url);
    $photos_arr = json_decode($json);

    // Если в ответе есть ошибка, обрабатываем её
    if (isset($photos_arr->error)) {
        $error = $photos_arr->error;
        $err = $error->error_code;

        // Обработка ошибки с кодом 5 (требуется ввод капчи)
        if ($err == 5) {
            echo "
                Ошибка: [" . $error->error_code . "] <b>" . $error->error_msg . "</b> <br><br>
                <img src=" . $error->captcha_img . ">
                <form action='page.php?id=albums'>
                <p>
                <input type='text' hidden name='id' value='albums'><Br>
                <input type='text' hidden name='captcha_sid' value=" . $error->captcha_sid . "><Br>
                <input type='text' name='captcha_key' value=''><Br>
                </p>
                <p><input type='submit'></p>
                </form>";
        }

        // Обработка ошибок с кодами 3, 4, 5 (некорректные параметры запроса)
        if ($err == 3 || $err == 4 || $err == 5) {
            $req_params = $error->request_params;
            echo $error->error_msg . " <br><pre>";
            print_r($req_params);
            echo "</pre>";
        }

        // Обработка ошибки с кодом 17 (требуется подтверждение действия)
        if ($err == 17) {
            $redirect_uri = $error->redirect_uri;
            echo "
            <form action=\"page.php?id=albums\" method=\"post\">
            <button type=\"submit\" name=\"redirect_uri\" value=\"$redirect_uri\">Go</button>
            </form>";
        }
    } else {
        // Если ошибок нет, обрабатываем ответ
        $response = $photos_arr->response;
        $albums_count = count($response);

        // Проходим по каждому альбому и сохраняем данные
        for ($i = 0; $i < $albums_count; $i++) {
            foreach ($response[$i] as $key => $value) {
                $param[$i][$key] = $value;
            }
            $album_title[$param[$i]['aid']] = $param[$i]['title'];
        }
    }
}

/**
 * Функция для получения информации о группе по её ID.
 *
 * @param string $group_ids ID группы (или несколько ID через запятую).
 */
function groups_getById($group_ids) {
    // Поля, которые мы хотим получить от API
    $GIfields = "city, country, place, description, wiki_page, members_count, counters, start_date, finish_date, can_post, can_see_all_posts, activity, status, contacts, links, fixed_post, verified, site, ban_info, cover";

    // Формируем URL для запроса к VK API
    $url = 'https://api.vk.com/method/groups.getById?group_ids=' . $group_ids . '&fields=' . $GIfields;
    
    // Выполняем запрос к API и декодируем JSON-ответ
    $group_json = file_get_contents($url);
    $group_arr = json_decode($group_json);

    // Если ответ содержит данные, выводим название группы
    if (isset($group_arr->response)) {
        $group_info = $group_arr->response;
        $gname = $group_info[0]->name;
        $gid = $group_info[0]->gid;

        print $gname;
    } else {
        print "Ошибка при получении информации о группе.";
    }
}

/*
Пример ответа от VK API для функции groups_getById:
{
    "response": [{
        "gid": 00000000,
        "name": "Имя заветной группы",
        "screen_name": "SHORT_NAME",
        "is_closed": 0,
        "type": "group",
        "is_admin": 0,
        "is_member": 0,
        "description": "Описание группы!",
        "photo": "https://pp.userap...ad7/u3apuk3nKek.jpg",
        "photo_medium": "https://pp.userap...ad6/jIsScXTOT5g.jpg",
        "photo_big": "https://pp.userap...ad5/7E-LEsUfG4k.jpg"
    }]
}
*/

?>