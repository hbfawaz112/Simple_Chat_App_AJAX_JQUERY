var i = 0;

function load() {
  i = i + 1;
  postMessage(i);
  setTimeout("load()",2000);
}

load();