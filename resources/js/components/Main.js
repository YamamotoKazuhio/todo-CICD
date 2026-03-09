import { Box } from "@mui/system";
import React from "react";
import ReactDOM from "react-dom";
import Home from "../pages/Home";
import Navigation from "./Navigation";
import { QueryClient, QueryClientProvider } from "react-query";

const client = new QueryClient();

function Main() {
  return (
    <QueryClientProvider client={client}>
      <Box>
        <Navigation />
        <main className="m-5">
          {/* Router‚ğˆê’UÁ‚µ‚ÄAHome‚ğ’¼Ú’u‚­ */}
          <Home />
        </main>
      </Box>
    </QueryClientProvider>
  );
}

export default Main;
ReactDOM.render(<Main />, document.getElementById("app"));