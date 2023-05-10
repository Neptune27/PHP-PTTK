<?php
    if (!isset($data)) {
        $data=[];
    }
?>
<style>
    #artistPagination > li:hover {
        cursor: pointer;
    }
</style>

<div class="resGrid" style="padding: 1rem">
<!--    --><?php
//        if (isset($data["artist"])) {
//            foreach ($data["artist"] as $index => $datum) {
//                ["USER_ID" => $userID, "NAME"=>$name, "AVATAR"=>$avatar] = $datum;
//                echo <<<WUT
//                    <a href="/Admin/AddSongPage/{$userID}" class="card shadow p-3 bg-white rounded cardItem">
//                        <div>
//                            <img class="card-img-top" src="{$avatar} " alt="Cover" style=" background-position: center; max-height: 100px; object-fit: cover;">
//                        </div>
//                        <div class="card-body d-flex flex-column align-items-center justify-content-center">
//                            <h5 class="card-title">{$name}</h5>
//                            <div>
//                                <button class="btn btn-primary"
//                                onclick="event.preventDefault();
//                                        window.location.href='/Admin/EditArtist/{$userID}'">
//                                    Sửa
//                                </button>
//                                <button class="btn btn-secondary"
//                                onclick="event.preventDefault();
//                                        delArtist({$userID})"
//                                >Xóa</button>
//                            </div>
//                        </div>
//                    </a>
//                WUT;
//            }
//        }
//    ?>


</div>

<div style="display: flex; justify-content: flex-end; padding: 1rem">
    <ul class="pagination" id="artistPagination">
        <li class="page-item"><a class="page-link">Previous</a></li>
        <li class="page-item"><a class="page-link">1</a></li>
        <li class="page-item"><a class="page-link">2</a></li>
        <li class="page-item"><a class="page-link">3</a></li>
        <li class="page-item"><a class="page-link">Next</a></li>
    </ul>
</div>

<script>
//    Bien toan cuc moi trang duoc hien thi bao nhieu nghe si
    let artistPerPage = 3;
// Bien dung de theo doi minh dang o page nao
    let youAreHere = 1;

    function delArtist(userID) {
        let fetchFrom = `/Admin/DeleteArtist/${userID}`;
        fetch(fetchFrom)
            .then(data => console.log(data))
            .then(() => window.location.href = '/Admin/AddSongPage')
            .catch(err => console.log(err));
    }

    function createPagination(maxPage, currentPage, artists) {
        let artistPagination = document.getElementById("artistPagination");
        currentPage = Number(currentPage);
        maxPage = Number(maxPage);
        if (currentPage > maxPage) {
            artistPagination.innerHTML = '';
            return;
        }
        // Tạo ra phân trang
        let page = '';
        // Neu trang hien tai la 1 thi chi hien trang 1, 2, 3 va khong hien previous
        if (currentPage === 1) {
            if (maxPage > 3) {
                page += `<li class="page-item"><a class="page-link">${currentPage}</a></li>
                        <li class="page-item"><a class="page-link">${currentPage + 1}</a></li>
                        <li class="page-item"><a class="page-link">${currentPage + 2}</a></li>
                        <li class="page-item"><a class="page-link">...</a></li>
                        <li class="page-item"><a class="page-link">Next</a></li>`;
            }
            else {
                if (maxPage === 1) { // neu trang hien tai la 1 ma tat ca trang chi co 1 thi hien thi minh trang do thoi
                    page += `<li class="page-item"><a class="page-link">1</a></li>`;
                } else {
                    for (let i=1; i<=maxPage; i++) {
                        page += `<li class="page-item"><a class="page-link">${i}</a></li>`;
                    }
                    page += '<li class="page-item"><a class="page-link">Next</a></li>';
                }
            }
        } else if (currentPage === maxPage) { // Neu page hien tai o vi tri cuoi cung
            if (maxPage > 3) {
                page += `<li class="page-item"><a class="page-link">Previous</a></li>
                        <li class="page-item"><a class="page-link">...</a></li>
                        <li class="page-item"><a class="page-link">${currentPage - 2}</a></li>
                        <li class="page-item"><a class="page-link">${currentPage - 1}</a></li>
                        <li class="page-item"><a class="page-link">${currentPage}</a></li>`;
            }
            else {
                page += '<li class="page-item"><a class="page-link">Previous</a></li>';
                for (let i=1; i<=maxPage; i++) {
                    page += `<li class="page-item"><a class="page-link">${i}</a></li>`;
                }
            }
        } else if (currentPage === maxPage - 1) { // Neu trang hien tai dang nam o vi tri ke cuoi
            if (maxPage > 3) {
                page += `<li class="page-item"><a class="page-link">Previous</a></li>
                        <li class="page-item"><a class="page-link">...</a></li>
                        <li class="page-item"><a class="page-link">${currentPage - 1}</a></li>
                        <li class="page-item"><a class="page-link">${currentPage}</a></li>
                        <li class="page-item"><a class="page-link">${currentPage + 1}</a></li>
                        <li class="page-item"><a class="page-link">Next</a></li>`;
            }
            else {
                page += '<li class="page-item"><a class="page-link">Previous</a></li>';
                for (let i=1; i<=maxPage; i++) {
                    page += `<li class="page-item"><a class="page-link">${i}</a></li>`;
                }
                page += '<li class="page-item"><a class="page-link">Next</a></li>';
            }
        } else if (currentPage === 2) { // Neu trang hien tai dang nam o vi tri ke dau
            if (maxPage > 3) {
                page += `<li class="page-item"><a class="page-link">Previous</a></li>
                        <li class="page-item"><a class="page-link">${currentPage - 1}</a></li>
                        <li class="page-item"><a class="page-link">${currentPage}</a></li>
                        <li class="page-item"><a class="page-link">${currentPage + 1}</a></li>
                        <li class="page-item"><a class="page-link">...</a></li>
                        <li class="page-item"><a class="page-link">Next</a></li>`;
            }
            else {
                page += '<li class="page-item"><a class="page-link">Previous</a></li>';
                for (let i=1; i<=maxPage; i++) {
                    page += `<li class="page-item"><a class="page-link">${i}</a></li>`;
                }
                page += '<li class="page-item"><a class="page-link">Next</a></li>';
            }
        } else { // Neu trang hien tai dang nam o giua
            if (maxPage > 3) {
                page += `<li class="page-item"><a class="page-link">Previous</a></li>
                        <li class="page-item"><a class="page-link">...</a></li>
                        <li class="page-item"><a class="page-link">${currentPage - 1}</a></li>
                        <li class="page-item"><a class="page-link">${currentPage}</a></li>
                        <li class="page-item"><a class="page-link">${currentPage + 1}</a></li>
                        <li class="page-item"><a class="page-link">...</a></li>
                        <li class="page-item"><a class="page-link">Next</a></li>`;
            }
            else {
                page += '<li class="page-item"><a class="page-link">Previous</a></li>';
                for (let i=1; i<=maxPage; i++) {
                    page += `<li class="page-item"><a class="page-link">${i}</a></li>`;
                }
                page += '<li class="page-item"><a class="page-link">Next</a></li>';
            }
        }
        artistPagination.innerHTML = page;
        addClickEventForPagination(maxPage, artists);
    }

    function addClickEventForPagination(maxPage, artists) {
        maxPage = Number(maxPage);
        //     Them su kien cho cac nut phan trang
        let pageElement = document.querySelectorAll("#artistPagination > li");
        pageElement.forEach(element => {
            element.onclick = function (e) {
                e.stopPropagation();
                let current = element.innerText;

                // Neu current dang la so
                if (Number(current)) {
                    youAreHere = Number(current);
                    loadDataCurrentPage(artists, youAreHere, artistPerPage);
                    createPagination(maxPage, youAreHere, artists);
                } else if (current === 'Previous' && youAreHere > 1) {
                    youAreHere = youAreHere - 1;
                    loadDataCurrentPage(artists, youAreHere, artistPerPage);
                    createPagination(maxPage, youAreHere, artists);
                } else if (current === "Next" && youAreHere < maxPage) {
                    youAreHere = youAreHere + 1;
                    loadDataCurrentPage(artists, youAreHere, artistPerPage);
                    createPagination(maxPage, youAreHere, artists);
                }
            };
        });
    }

    function loadDataSongArtist(artists) {
        let maxPage = Math.ceil(artists.length / artistPerPage);
        // Tao phan trang
        createPagination(maxPage, youAreHere, artists);
        // Tai du lieu len resGrid
        loadDataCurrentPage(artists, youAreHere, artistPerPage);
    //     Them su kien cho nut phan trang
        addClickEventForPagination(maxPage, artists);

    }

    function loadDataCurrentPage(artists, currentPage, artistPerPage) {
        // lay vi tri bat dau va ket thuc theo so trang hien tai
        let from = artistPerPage * (currentPage - 1);
        let to = from + artistPerPage;

        let searchResult = '';
        for (let i = from; i < to; i++) {
            if (!artists[i]) { // kiem tra o vi tro do co ton tai phan tu khong, neu khong co thi thoat khoi vong lap
                break;
            }
            searchResult += `<a href="/Admin/AddSongPage/${artists[i].USER_ID}" class="card shadow p-3 bg-white rounded cardItem">
                                <div>
                                    <img class="card-img-top" src="${artists[i].AVATAR} " alt="Cover" style=" background-position: center; max-height: 100px; object-fit: cover;">
                                </div>
                                <div class="card-body d-flex flex-column align-items-center justify-content-center">
                                    <h5 class="card-title">${artists[i].NAME}</h5>
                                    <div>
                                        <button class="btn btn-primary"
                                                onclick="event.preventDefault();
                                                        window.location.href='/Admin/EditArtist/${artists[i].USER_ID}'">
                                            Sửa
                                        </button>
                                        <button class="btn btn-secondary"
                                                onclick="event.preventDefault();
                                                        delArtist(${artists[i].USER_ID})"
                                        >Xóa</button>
                                    </div>
                                </div>
                            </a>`;
        }

        document.querySelector('.resGrid').innerHTML = searchResult;
    }

    function fetchForPage(searchInput) {
        let fetchFrom = "/Admin/GetArtistByName";

        let data = {
            artistName: searchInput,
        };

        fetch(fetchFrom, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: new URLSearchParams(data)
        })
            .then(res => res.json())
            .then(data => {
                // Khi du lieu xong se cho dung o dau trang
                youAreHere = 1;
                // Tai du lieu cho page
                loadDataSongArtist(data.artists);
            })
            .catch(data => console.log(data));
    }

    fetchForPage("");

    // Bắt sự kện search
    document.getElementById("button-addon2").onclick = function (e) {
        e.stopPropagation();
        e.preventDefault();
        let searchInput = this.closest("div").querySelector("input[placeholder='Tìm kiếm']").value.trim();
        fetchForPage(searchInput);

    };
</script>
