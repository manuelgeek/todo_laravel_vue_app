/* eslint-disable no-param-reassign */
const clearForm = (data) => {
  Object.keys(data).forEach((key) => {
    data[key] = '';
  });
};

export default {
  clearForm,
};
