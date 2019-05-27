import React from 'react';
import PropTypes from 'prop-types';

import styles from './styles.css';

const DialogTitle = ({ children }) => <h6 className={styles.title}>{children}</h6>;

DialogTitle.defaultProps = {};

DialogTitle.propTypes = {};

export default DialogTitle;
