"use client";

/* Core */
import { reduxStore } from "../store";
import { persistStore } from "redux-persist";
import { Provider } from "react-redux";

persistStore(reduxStore); // persist the store

export const Providers = (props: React.PropsWithChildren) => {
  return <Provider store={reduxStore}>{props.children}</Provider>;
};
