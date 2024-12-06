import { combineReducers } from "@reduxjs/toolkit";
import { persistReducer } from "redux-persist";
import customStorage from "./customStorage";
import { analyzerApi } from "@/api/baseQueries/analyzer";

const rootReducer = combineReducers({
  [analyzerApi.reducerPath]: analyzerApi.reducer,
});

const persistedReducers = persistReducer(
  {
    key: "rv2-apps",
    version: 2,
    storage: customStorage,
  },
  rootReducer
);

export const reducer = combineReducers({
  persistedReducers,
  [analyzerApi.reducerPath]: analyzerApi.reducer,
});
