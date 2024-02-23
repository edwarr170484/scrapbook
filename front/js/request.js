const request = async function (method, url, formData = null) {
  let options = {
    method: method,
  };

  if (formData) {
    options.body = formData;
  }

  try {
    let response = await fetch(url, options);

    let result = await response.json();

    return {
      response: response,
      result: result,
    };
  } catch (error) {
    return {
      status: response,
      result: error.message,
    };
  }
};

module.exports = request;
