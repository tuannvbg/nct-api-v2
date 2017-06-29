# nct-api-v2

Bộ API miễn phí cho phép truy cập vào dữ liệu máy chủ NhacCuaTui.Com
##Update Liên Tục

## Ver 1.0: 5 function: getSongDetail,getVideoDetail,getLyric,getSongSearch,getVideoSearch


## Install - Cài Đặt
Cài đặt thông qua Git:
`git clone https://github.com/phuchptty/nct-api-v2`

Cài đặt qua Composer
`composer phuchptty/nct-api-v2`

### Thêm thư viện API
`require_once("sdk.php")`

## Các Function Chính

### getSongDetail()
Cú pháp: `NCT::getSongDetail($songid)`
Trong đó: `$songid` là ID của bài hát trên Nhaccuatui

Ví dụ: http://www.nhaccuatui.com/bai-hat/fly-away-thefatrat-ft-anjulie.HUrRmiQuz1P7.html
Thì `HUrRmiQuz1P7` là ID của bài hát

### getSongDetail() và getPlaylistDetail() dùng tương tự

### getLyric
Cú phát: `NCT::getLyric($songid)`
Trong đó: `$songid` là ID của bài hát trên Nhaccuatui

Ví dụ: http://www.nhaccuatui.com/bai-hat/fly-away-thefatrat-ft-anjulie.HUrRmiQuz1P7.html
Thì `HUrRmiQuz1P7` là ID của bài hát

### getSongSearch
Cú pháp `NCT::getSongSearch($keyword,$page,$num)`
Trong đó: `keyword` là từ khóa cần tìm
          `page` là số trang tìm kiếm
          `num` là số tìm kiếm mỗi trang
        
### getSongSearch tương tự 
