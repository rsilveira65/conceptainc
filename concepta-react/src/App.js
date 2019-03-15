import React, { Component } from 'react';
import './App.css';
import './bootstrap.min.css';

class App extends Component {

    constructor() {
        super();
        this.state = {
            data: []
        }
    }

    componentDidMount() {
        fetch('http://localhost/wp-json/concepta/v1/tickets', {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(findresponse => {
            this.setState({
                data: [findresponse]
            });
        })
    }

    render() {
        return (
            <table class="table table-dark">
                <thead>
                    <tr>
                        <th scope="col">Code</th>
                        <th scope="col">Destination</th>
                        <th scope="col">Name</th>
                        <th scope="col">Photos</th>
                    </tr>
                </thead>
                {
                    this.state.data.map((dynamicData) => {
                        let keys = Object.keys(dynamicData);
                        return keys.map(data => {
                            return (
                                <tbody>
                                    <tr>
                                        <td>{dynamicData[data].code}</td>
                                        <td>{dynamicData[data].destination}</td>
                                        <td>{dynamicData[data].name}</td>
                                        <td>
                                            {
                                                dynamicData[data].photos.map(photo => {
                                                    return (<a href={photo.Url} target="_blank"> <img src={photo.Url} width="100" height="50"/></a>);
                                                })
                                            }
                                        </td>
                                    </tr>
                                </tbody>
                            );
                        });
                    })

                }
            </table>
        )
    }
}

export default App;
