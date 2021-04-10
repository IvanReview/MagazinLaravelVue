
function is_numeric(data){

    return  !isNaN(data)
}


export  function makePagination(data) {
    //засовываем параметры пагинации в объект, который будет перезаписан, каждый раз при вызов метода

    const pagination = {

        current_page: data.current_page,
        last_page: data.last_page,
        next_page_url: data.next_page_url,
        prev_page_url: data.prev_page_url,
        pages: data.links.filter(item => is_numeric(item.label)),
    };

    return pagination
}


export  function makePaginationForAdmin(data) {
    //засовываем параметры пагинации в объект, который будет перезаписан, каждый раз при вызов метода


    const pagination = {
        current_page: data.current_page,
        last_page: data.last_page,
        next_page_url: data.next_page_url,
        prev_page_url: data.prev_page_url,
        pages: data.links.filter(item => is_numeric(item.label))
    };

    return pagination
}


export  function makePaginationForAdminOrders(data) {
    //засовываем параметры пагинации в объект, который будет перезаписан, каждый раз при вызов метода

    const pagination = {
        current_page: data.current_page,
        last_page: data.last_page,
        next_page_url: data.next_page_url,
        prev_page_url: data.prev_page_url,
        pages: data.links.filter(item => is_numeric(item.label)),
    };

    return pagination
}


