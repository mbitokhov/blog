export default {
  setLocalStorage: function (key, val) {
    if (typeof Storage === "undefined") {
      return;
    }
    localStorage.setItem(key, JSON.stringify(val));
  },
  getLocalStorage: function (key, def) {
    if (typeof Storage === "undefined") {
      return def;
    }
    var val = localStorage.getItem(key)

    return val === null ? def : JSON.parse(val);
  }
}