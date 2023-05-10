<?php
if (!isset($data)) {
    $data = [];
}
$uriChunk = explode("/", $_GET["url"]);
$name = "";
$duration = 0;

if (isset($data["Song"][0])) {
    [
        "SONG_NAME" => $name,
        "DURATION" => $duration
    ] = $data["Song"][0];
}


//if (isset($data["Song"])) {
//    echo "disabled";
//}
echo count($data["Song"]);
if (count($data["Song"]) != 0) {
    echo "A";
}
//print_r($data["Song"])
?>


<link rel="stylesheet" href="/Src/Client/css/Login/Login.css">

<script src="/Src/Client/js/AddLyric.js" defer></script>
<script src="/Src/Client/js/SongSubmit.js" defer></script>


<div class="loginMain d-flex flex-column align-items-center">
    <div class="loginContent">
        <?php
        if (isset($data["Song"])) {
            if (!isset($data["Song"][0])) {
                $data["Song"][0] = [
                    "SONG_ID" => 0, "SONG_NAME"=>"Add new song",
                ];
            }
            [
                "SONG_ID" => $songID, "SONG_NAME"=>$songName,
            ] = $data["Song"][0];
            [
                "USER_ID" => $userID, "NAME"=>$artistName,
            ] = $data["artist"][0];
            [
                "ALBUM_ID" => $albumID, "ALBUM_NAME"=>$albumName,
            ] = $data["Albums"][0];

            if ($data)
            echo <<<OK
        <ol class="arrows" style="overflow-x: hidden">
            <li><a href="/Admin">Home</a></li>
            <li><a href="/Admin/AddSongPage/{$userID}">{$artistName}</a></li>
            <li><a href="/Admin/AddSongPage/{$userID}/{$albumID}">{$albumName}</a></li>
            <li><a href="/Admin/AddSongPage/{$userID}/{$albumID}/{$songID}">{$songName}</a></li>
        </ol>
    OK;
        }
        ?>
        <section class="m-auto bg-white rounded-4 text-dark">
            <h1 class="text-center p-4 fw-bold">Thêm bài hát</h1>
            <div id="signInForm" class="p-4 needs-validation">

                <div class="mt-4 has-validation">
                    <label for="songName" class="h5">Tên bài hát</label>
                    <input type="text" name="songName" class="form-control flex-fill mb-0"
                           placeholder="Tên bài hát" id="songName" value="<?php echo $name?>">
                </div>
                <div class="mt-4">
                    <label for="song" class="h5">Bài hát</label>
                    <input type="file" name="song" class="form-control flex-fill mb-0" id="song" <?php
                        if (isset($data["Song"])) {
                            if ($data["Song"][0]["SONG_ID"] != 0) {
                                echo "disabled";
                            }
                        }
                    ?>>
                </div>
                <div class="mt-4">
                    <label for="songDuration" class="h5">Thời gian phát</label>
                    <input type="text" name="songDuration" class="form-control flex-fill mb-0" id="songDuration"  value="<?php echo $duration?>">
                </div>
                <div class="mt-4">
                    <label for="song" class="h5">Lời bài hát</label>
                    <div id="LyricSection">

                    </div>
<!--                    <div class="d-flex gap-2">-->
<!--                        <input type="text" class="form-control" placeholder="TG" style="width: 4rem">-->
<!--                        <input type="text" class="form-control" placeholder="Lời bài hát" >-->
<!--                        <button class="btn btn-outline-danger">Xóa</button>-->
<!--                    </div>-->
                    <button id="AddLyricBtn" class="btn btn-outline-primary mt-4" style="width: 100%">Thêm lời bài hát</button>
                </div>
                <div class="d-flex justify-content-center gap-1">
                    <button type="submit" class="btn btn-primary text-break mt-5" style="width: 100%">Xác nhận</button>
                    <button class="btn btn-secondary text-break mt-5" style="width: 100%">Thoát</button>
                </div>
            </div>
        </section>
    </div>
</div>


<script>
    const inputElement = document.querySelector('input#song');

    window.fileName = "";

    FilePond.registerPlugin(FilePondPluginFileValidateType);

    const pond = FilePond.create(inputElement, {
        storeAsFile: true,
        // set allowed file types with mime types
        acceptedFileTypes: [
            "audio/mpeg"
        ],
        allowBrowse: true,
        server: {
            process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                // fieldName is the name of the input field
                // file is the actual file object to send
                const formData = new FormData();

                formData.append(fieldName, file, file.name);
                window.fileName = file.name

                const request = new XMLHttpRequest();
                <?php
                echo "request.open('POST', '/Admin/SongUpload/{$uriChunk[2]}/{$uriChunk[3]}?type=song');";
                ?>

                // Should call the progress method to update the progress to 100% before calling load
                // Setting computable to false switches the loading indicator to infinite mode
                request.upload.onprogress = (e) => {
                    progress(e.lengthComputable, e.loaded, e.total);
                };

                // Should call the load method when done and pass the returned server file id
                // this server file id is then used later on when reverting or restoring a file
                // so your server knows which file to return without exposing that info to the client
                request.onload = function () {
                    if (request.status >= 200 && request.status < 300) {
                        // the load method accepts either a string (id) or an object
                        load(request.responseText);
                    } else {
                        // Can call the error method if something is wrong, should exit after
                        error('oh no');
                    }
                };

                request.send(formData);

                // Should expose an abort method so the request can be cancelled
                return {
                    abort: () => {
                        // This function is entered if the user has tapped the cancel button
                        request.abort();

                        // Let FilePond know the request has been cancelled
                        abort();
                    },
                };
            },
            revert: async (source, load, error) => {
                const res = await fetch(`/Admin/SongUpload/Test?type=song&songName=${fileName}`, {
                    method: "DELETE"
                })

                load()
            }
        }

    });

</script>
