alert('ini load dari file test.js');

if(confirm('apakah anda yakin merubah tampilan?')){
    alert(document.getElementsByTagName('body')[0].style.backgroundColor = 'red');
}