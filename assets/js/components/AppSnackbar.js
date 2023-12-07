//REACT
import React, {useContext, useState} from 'react';
//CONTEXT
import {TodoContext} from '../contexts/TodoContext';
//MUI COMPONENTS
import {Snackbar, useTheme} from '@material-ui/core';
import MuiAlert from '@material-ui/lab/Alert';


function AppSnackbar(props) {
    const context = useContext(TodoContext);
    const {text, level} = context.message;


    return (
        <Snackbar color="secondary" autoHideDuration={1000} open={context.message.text !== undefined}>
            <MuiAlert variant="filled" onClose={() => context.setMessage({})}
                      severity={level === 'success' ? 'success' : 'warning'}>{text}</MuiAlert>
        </Snackbar>
    );
}

export default AppSnackbar;