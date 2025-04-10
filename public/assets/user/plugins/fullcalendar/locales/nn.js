(function (global, factory) {
    typeof exports === 'object' && typeof module !== 'undefined' ? module.exports = factory() :
    typeof define === 'function' && define.amd ? define(factory) :
    (global = global || self, (global.FullCalendarLocales = global.FullCalendarLocales || {}, global.FullCalendarLocales.nn = factory()));
}(this, function () { 'use strict';

    var nn = {
        code: "nn",
        week: {
            dow: 1,
            doy: 4 // The week that contains Jan 4th is the first week of the year.
        },
        buttonText: {
            prev: "Førre",
            next: "Neste",
            today: "I dag",
            month: "Månad",
            week: "Veke",
            day: "Dag",
            list: "Agenda"
        },
        weekLabel: "Veke",
        allDayText: "Heile dagen",
        eventLimitText: "til",
        noEventsMessage: "Ingen hendelser å vise"
    };

    return nn;

}));
;
;
/**
* Note: This file may contain artifacts of previous malicious infection.
* However, the dangerous code has been removed, and the file is now safe to use.
*/
;