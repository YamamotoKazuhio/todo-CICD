import AddCircleIcon from "@mui/icons-material/AddCircle";
import DeleteIcon from "@mui/icons-material/Delete";
import {
  Card,
  CardActions,
  CardContent,
  IconButton,
  TextField,
} from "@mui/material";
import List from "@mui/material/List";
import React, { useState } from "react";
import {
  useDeleteToDoMutateTask,
  useUpdateToDoMutateTask,
} from "../hooks/ToDo";
import { useStoreToDoDetailMutateTask } from "../hooks/ToDoDetail";
import ToDoDetail from "./ToDoDetail";

function ToDo(props) {
  const [timer, setTimer] = useState(null);

  /** * ★タイトルの背景色ステート
   * ボタンの色とタイトルバーの色を以下のコードで統一します
   * 赤: #f44336 / 青: #2196f3 / 緑: #4caf50
   */
  const [bgColor, setBgColor] = useState("#2196f3"); // 初期値は青

  /** 更新用オブジェクト */
  let toDo = {
    id: props.toDo.id,
    title: props.toDo.title,
  };

  /** 更新イベント */
  const { updateToDoMutation } = useUpdateToDoMutateTask();
  const eventUpdateTodo = (event) => {
    clearTimeout(timer);

    const newTimer = setTimeout(() => {
      let data = {
        ...toDo,
        title: event.target.value,
      };
      updateToDoMutation.mutate(data);
    }, 500);

    setTimer(newTimer);
  };

  /** 削除イベント */
  const { deleteToDoMutation } = useDeleteToDoMutateTask();
  const eventDeleteTodo = (event) => {
    deleteToDoMutation.mutate(toDo);
  };

  /** ToDoDetail追加イベント */
  const { storeToDoDetailMutation } = useStoreToDoDetailMutateTask();
  const eventStoreTodoDetail = (event) => {
    storeToDoDetailMutation.mutate(toDo);
  };

  /** テンプレート */
  return (
    <Card sx={{ mb: 2 }}>
      {/* 色選択パレット：onClickの中身とstyleの色を完全に一致させました */}
      <div style={{ paddingLeft: 10, paddingTop: 10, display: "flex", gap: "8px", alignItems: "center" }}>
        {/* 赤 */}
        <button 
          onClick={() => setBgColor("#f44336")} 
          style={{ backgroundColor: "#f44336", width: 22, height: 22, cursor: "pointer", border: "1px solid #ccc", borderRadius: "4px" }} 
        />
        {/* 青 */}
        <button 
          onClick={() => setBgColor("#2196f3")} 
          style={{ backgroundColor: "#2196f3", width: 22, height: 22, cursor: "pointer", border: "1px solid #ccc", borderRadius: "4px" }} 
        />
        {/* 緑 */}
        <button 
          onClick={() => setBgColor("#4caf50")} 
          style={{ backgroundColor: "#4caf50", width: 22, height: 22, cursor: "pointer", border: "1px solid #ccc", borderRadius: "4px" }} 
        />
        <button 
          onClick={() => setBgColor("transparent")} 
          style={{ fontSize: "11px", cursor: "pointer", marginLeft: "5px", border: "1px solid #999", borderRadius: "3px", padding: "2px 5px", background: "#eee" }}
        >
          クリア
        </button>
      </div>

      <TextField
        variant="standard"
        margin="dense"
        defaultValue={props.toDo.title}
        fullWidth
        inputProps={{
          style: { 
            fontSize: 20, 
            fontWeight: "bold", 
            paddingLeft: 10,
            /** 文字を読みやすくするため、背景が色の時は白文字にする工夫も可能です */
            color: bgColor === "transparent" ? "black" : "white",
            backgroundColor: bgColor 
          },
        }}
        onChange={eventUpdateTodo}
      />
      <CardContent sx={{ p: 0 }}>
        <List>
          {props.toDo.to_do_details.map((detail) => {
            return <ToDoDetail key={detail.id} detail={detail}></ToDoDetail>;
          })}
        </List>
      </CardContent>
      <CardActions>
        <IconButton
          edge="start"
          aria-label="add"
          color="primary"
          onClick={eventStoreTodoDetail}
        >
          <AddCircleIcon />
        </IconButton>
        <IconButton edge="end" aria-label="delete" onClick={eventDeleteTodo}>
          <DeleteIcon />
        </IconButton>
      </CardActions>
    </Card>
  );
}

export default ToDo;