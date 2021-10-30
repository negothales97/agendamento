import React from 'react';

import { BrowserRouter, Route, Switch } from 'react-router-dom';
import Calendar from './pages/Calendar';

const Routes = () => {
    return (
        <BrowserRouter>
            <Switch>
                <Route exact path="/specialist/calendars" component={Calendar} />
            </Switch>
        </BrowserRouter>
    );
}

export default Routes;
